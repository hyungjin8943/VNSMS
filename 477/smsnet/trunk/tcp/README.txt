version 0.11

This version works for messages up to a size of roughly 1KB

On the remote end, call sendMessage(string server, string message) to send message to server using ITP.
server should be the domain name (eg. aludra.usc.edu)
This should be called for every text independently, and creates an independent TCP/IP connection

On the server end, call setup(int receiveBufferSize) to create a connection.
	NOTE: This sets up an infinite loop
The connection calls parse(string message) with every message received.
	NOTE: Expects return of 0 on success and -1 on error
call tearDown() to interupt the loop and close the connection