#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <netdb.h>
#include <string>
#include <iostream>
#include <sstream>
#include <fstream>

using namespace std;

int main(int argc, char *argv[]) {
 if (argc < 5) {
  cout << "incorrect format: ./myclient host port_number request URL\n";
  exit(1);
 }
    
 int sockfd, portno;
 struct sockaddr_in serv_addr;
 struct hostent *server;
 portno = atoi(argv[2]);

 // create a socket
 sockfd = socket(AF_INET, SOCK_STREAM, 0);
 if (sockfd < 0) {
  cout << "Failed to open socket\n";
  exit(1);
 }
 
 // get host server info
 server = gethostbyname(argv[1]);
 if (server == NULL) {
  cout << "ERROR, no such host\n";
  close(sockfd);
  exit(1);
 }
 
 // setup host addr structure
 bzero((char *) &serv_addr, sizeof(serv_addr));
 serv_addr.sin_family = AF_INET;
 bcopy((char *)server->h_addr, (char *)&serv_addr.sin_addr.s_addr, server->h_length);
 serv_addr.sin_port = htons(portno);
 
 // connect to host server
 if (connect(sockfd,(struct sockaddr *) &serv_addr,sizeof(serv_addr)) < 0) {
  cout << "Failed to connect\n";
  close(sockfd);
  exit(1);
 }
 
 // either GET or PUT request
 string request = argv[3];
 // file to get or put to/from server
 string source = argv[4];
 stringstream ss;
 
 // if-else to check whether to do GET or PUT request
 if (request.compare("GET") == 0) {
  // create GET request message
  ss << request << " /" << source << " HTTP/1.0\r\nHost: " << argv[1] << "\r\nUser-Agent: Firefox/56.0\r\nAccept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\nAccept-Language: en-US,en;q=0.5\r\nAccept-Encoding:gzip, deflate\r\n\r\n";
 } else {
  // PUT method
  // open file for input
  ifstream ifs(source.c_str(), ifstream::binary);
  // check if file successfully opened
  if (ifs.is_open()) {
   // read from file and store into new buffer
   filebuf* pbuf = ifs.rdbuf();
   size_t size = pbuf->pubseekoff(0, ifs.end,ifs.in);
   pbuf->pubseekpos(0, ifs.in);
   char* buffer = new char[size];
   pbuf->sgetn(buffer, size);
   ifs.close();
   // create PUT request message
   ss << request << " /" << source << " HTTP/1.0\r\nHost: " << argv[1] << "\r\nContent-Type: text/html\r\nContent-Length: " << size << "\r\n\r\n";
   // append file data to end of reponse message
   ss.write(buffer, size);
   delete[] buffer;
  } else {
   cout << "File failed to open\n";
   close(sockfd);
   exit(1);
  }
 }
 
 // send request message to server
 string message = ss.str();
 if (send(sockfd, message.c_str(), message.size(), 0) < 0) {
  cout << "Failed to send\n";
  close(sockfd);
  exit(1);
 }
 
 // read message from server and store into response array
 char response[10000];
 bzero(response, 10000);
 if (recv(sockfd, response, 9999, 0) < 0) {
  cout << "Failed to recv\n";
  close(sockfd);
  exit(1);
 }
 
 // output reponse message
 message = response;
 cout << endl << message << endl;
 
 close(sockfd);
 return 0;
}
