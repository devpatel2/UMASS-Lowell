#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <iostream>
#include <arpa/inet.h>
#include <string>
#include <sys/stat.h>
#include <sstream>
#include <fstream>
#include <signal.h>

using namespace std;

// checks to see if file exists
inline bool file_check (const string &name) {
 struct stat buffer;
 return (stat(name.c_str(), &buffer) == 0);
}

// signal handler for alarm signal
void signal_handler_alarm(int sig) {
 _exit(1);
}

int main(int argc, char *argv[]) {
 // sets up signal handler
 signal(SIGALRM, signal_handler_alarm);
 if (argc < 2) {
  cout << "incorrect format: ./myserver port_number\n";
  exit(1);
 }
 
 int sockfd, ret_sockfd, portno;
 socklen_t clilen;
 struct sockaddr_in serv_addr, cli_addr;
 portno = atoi(argv[1]);

 // create a socket
 sockfd = socket(AF_INET, SOCK_STREAM, 0);
 if (sockfd < 0) {
  cout << "Failed to open socket\n";
  exit(1);
 }
 
 // setup host addr structure
 bzero((char *) &serv_addr, sizeof(serv_addr));
 serv_addr.sin_family = AF_INET;
 serv_addr.sin_addr.s_addr = INADDR_ANY;
 serv_addr.sin_port = htons(portno);
 
 // bind socket to IP address at port number
 if (bind(sockfd, (struct sockaddr*) &serv_addr, sizeof(serv_addr)) < 0) {
  cout << "Failed to Bind\n";
  close(sockfd);
  exit(1);
 }
 
 // listen for incoming connections
 listen(sockfd, 5);
 
 // accept a connection from client. Store client addr info into the client addr structure, and size into chilen. infinite loop starts here, as long as a connection is successfully accepted
 clilen = sizeof(cli_addr);
 while ((ret_sockfd = accept(sockfd, (struct sockaddr*) &cli_addr, &clilen)) >= 0) { 
  cout << "server: got connection from " << inet_ntoa(cli_addr.sin_addr) << " port " << ntohs(cli_addr.sin_port) << endl;
  
  // read message from client and store into buffer array
  char buffer[10000];
  bzero(buffer, 10000);
  if (recv(ret_sockfd, buffer, 9999, 0) < 0) {
   cout << "Failed to recv";
   close(ret_sockfd);
   close(sockfd);
   exit(1);
  }
 
  // Parse the file name from buffer
  string response = buffer;
  size_t pos = response.find("/") + 1;
  size_t pos1 = response.find(" ", pos + 1);
  string file = response.substr(pos, pos1 - pos); 
  stringstream ss;
 
  // get current date and time for response message to client
  time_t current = time(0);
  char* date_time = ctime(&current);
  date_time[24] = '\0';  // change '\n' to '\0'
 
  // if-else for checking is GET or PUT request should be done
  if (buffer[0] == 'G') {
   // check if file exists. If exists, response code 200 else 404
   if(file_check(file)) {
    // open file for reading
    ifstream ifs(file.c_str(), ifstream::binary);
    // check if file successfully opened
    if (ifs.is_open()) {
     // read from file and store into new buffer
     filebuf* pbuf = ifs.rdbuf();
     size_t size = pbuf->pubseekoff(0, ifs.end,ifs.in);
     pbuf->pubseekpos(0, ifs.in);
     char* buffer = new char[size];
     pbuf->sgetn(buffer, size);
     ifs.close();
     // create GET response message 
     ss << "HTTP/1.0 200 OK\r\n" << "Date: " << date_time << "\r\nServer: localhost:" << portno << "\r\nAccept-Ranges: bytes\r\nContent-Length: " << size << "\r\nContent-Type: text/html\r\nConnection: Closed\r\n\r\n";
     // append file data to end of reponse message
     ss.write(buffer, size);
     delete[] buffer;
    } else {
     cout << "File failed to open\n";
     close(ret_sockfd);
     close(sockfd);
     exit(1);
    }
   } else {
    ss << "HTTP/1.0 404 Not Found\r\n" << "Date: " << date_time << "\r\nServer: localhost:" << portno << "\r\n\r\n";
   }
  } else {
   // PUT request 
   ofstream ofs;
   // create/truncate file and open file for output.
   ofs.open(file.c_str(), ofstream::out | ofstream::trunc);
   // check if file successfully opened
   if (ofs.is_open()) {
    // find position where file data begins by looking for the last "\r\n" from request
    size_t posP1 = response.rfind("\r\n");
    string file_content = response.substr(posP1 + 2); 
    // writes to file
    ofs << file_content;
   } else {
    cout << "File failed to open\n";
    close(ret_sockfd);
    close(sockfd);
    exit(1);
   }
   ofs.close();
   // check is file was created successfully. respond with appropriate message
   if(file_check(file)) {
    ss << "HTTP/1.0 201 Created\r\n" << "Date: " << date_time << "\r\nServer: localhost:" << portno << "\r\n\r\nFile was created\n";
   } else {
    ss << "Failed to create file\n";
   }
  }
 
  // send response message to client
  response = ss.str();
  if (send(ret_sockfd, response.c_str(), response.size(), 0) < 0) {
   cout << "Failed to send\n";
   close(ret_sockfd);
   close(sockfd);
   exit(1);
  }
  // Sets alarm for 20 sec and signals the handler
  alarm(20);
 }
 
 // if accept failed to connect, send error message to client, close sockets, and close server
 if (ret_sockfd < 0) {
  send(ret_sockfd, "Failed to connect\n", 17, 0);
  close(ret_sockfd);
  close(sockfd);
  exit(1);
 }
 
 return 0;
}