Program Design
As the assignment required the implementation of two HTTP methods, I have used an if-else design. For both the server and client this was done. The implementation of both methods is done within the main function and not in separate function calls.

“How it Works”
Client:
	* Checks to see if there is the correct amount of command line variable used
	* Creates a socket
	* Captures the host server’s information and stores into an address structure
	* Connects to server
	* If-else chooses either GET or PUT route
		o GET method
			* Creates a request message
		o PUT method
			* Opens requested file for input
			* Reads and stores into a buffer array
			* Creates a request message
			* Appends file data to end of message
	* Sends request message to server
	* Receives response from server and displays
	* Cleans up and exits
Server:
	* Checks to see if there is the correct amount of command line variable used
	* Creates a socket
	* Setup host address structure
	* Binds the socket at the port number of the IP address
	* Listens for incoming connections
	* Infinite loop
		o Accepts a connection
		o Reads message from client and stores into a buffer array
		o Parse the file name from the buffer and get current time and date
		o If-else chooses either GET or PUT route
			* GET method
				* Opens requested file for input if found
				* Reads and stores into a buffer array
				* Creates a response message for either OK or Not Found
				* Appends file data to end of message if OK
			* PUT method
				* Creates/truncates file and opens requested file for output
				* Find where file data begins from message and write to file
				* Creates a response message for either file Created or Failure
		o Sends request message to server
		o Signal alarm to exit program on timeout
	* If failed to accept connection, send error message to client, clean up and exit on error

Improvements
	* Introduce more HTTP methods
	* Have function calls for methods currently and as more methods are introduced
	* When response code 302, redirect, occurs, have client send another request to new location 
