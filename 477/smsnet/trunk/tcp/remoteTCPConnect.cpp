#include "remoteTCPConnect.h"
#include <iomanip>
#include <iostream>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>
#include <netdb.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <sys/wait.h>
remoteTCPConnect::remoteTCPConnect()
{
	disconnect=false;
}
int remoteTCPConnect::setup(int receiveBufferLength)
{
	int newSock = 0;
	int rcvFlag = 0;
	int length = receiveBufferLength;
	char rcvBuffer[length];
	std::string contents;
	struct sockaddr_storage their_addr;
	socklen_t sin_size;	
	printf("\n\n\n");

	mainSockID = setupSocket();
	if(mainSockID == -1)
	{
		printf("error setting up socket \n");
		return -1;
	}	
	
	while(true)
	{
		sin_size = sizeof their_addr;
		newSock = accept(mainSockID, (struct sockaddr *)&their_addr, &sin_size);
		//std::cout<<"Connected.\n";
		if(newSock == -1)
		{
			perror("accept");
			continue;
		}
		//std::cout<<"Connection Confirmed.\n";
		rcvFlag = recv(newSock, rcvBuffer, length-1, 0);
		//std::cout<<"Receiving...\n";
		if(rcvFlag ==-1)
		{
			perror("receive");
			exit(1);
		}
		printf("The remote server has received information from the remote server\n");
		//std::cout<<"Reception confirmed.\n";
		rcvBuffer[rcvFlag] = '\0';
		contents=std::string(rcvBuffer);

		while(parse(contents)<0);

		close(newSock);

		if(disconnect)
			break;
	}
	close(mainSockID);
}

int remoteTCPConnect::setupSocket()
{
	int sock = 0;
	int TCPsock = 22061;
	int yes=1;
	int status = 0;
	int bindID =0;
	int listenID=0;
	struct addrinfo hints;
	struct addrinfo *res, *target; //points to results

	memset(&hints, 0, sizeof hints); //hints is empty
	hints.ai_family = AF_UNSPEC; //IPv4 or v6
	hints.ai_socktype = SOCK_STREAM; //TCP
	hints.ai_flags = AI_PASSIVE; //autofill IP addr

	char* name = (char*) malloc(64);
	int hostFlag=0;
	//get the host name of the server the code is running on
	hostFlag=gethostname(name,64);
	if(hostFlag == -1)
	{
    		perror("getting hostname");
    		exit(1);
	}

	if ((status = getaddrinfo(name, "22061", &hints, &res)) != 0) 
	{
    		fprintf(stderr, " getaddrinfo error: %s\n", gai_strerror(status));
    		exit(1);
	}

	//loop through the linked list provided by getaddrinfo and bind the first one I can
	for(target = res; target != NULL; target=target->ai_next)	{
		if((sock = socket(target->ai_family, target->ai_socktype, target->ai_protocol))==-1)
		{
			std::cout<<" Error creating socket! \n";
			perror("socket: ");
			continue;//exit(1);
		}
		if(setsockopt(sock,SOL_SOCKET,SO_REUSEADDR,&yes,sizeof(int)) == -1)
		{
			perror("setsockopt");
			exit(1);
		}
		if(bind(sock,target->ai_addr,target->ai_addrlen) == -1)
		{
			close(sock);
			perror("bind");
			continue;
		}
		break;
	}
	if(target == NULL)
	{
		fprintf(stderr, "failed to bind socket\n");
		exit(2);
	}
	
	listenID = listen(sock,5);
	if(listenID ==-1)
	{
		std::cout<<" Error listening on socket! \n";
		perror("listen: ");
		exit(1);
	}

	char* ip4;
	ip4 = (char*) malloc(64);
	struct sockaddr_in *ipv4 = (struct sockaddr_in *)target->ai_addr;
	void* addr;
	int portNumber;
	portNumber = ntohs(ipv4->sin_port);
	addr= &(ipv4->sin_addr);
	inet_ntop(target->ai_family,addr, ip4, target->ai_addrlen);
	printf("The remote server has TCP port number %i and IP address %s\n",portNumber,ip4);
	freeaddrinfo(res);
	return sock;
}
int remoteTCPConnect::tearDown()
{
	disconnect=true;
}
int remoteTCPConnect::parse(std::string data)
{
	std::cout<<" Server received message: '"<<data<<"'"<<std::endl;
	return 0;
}
