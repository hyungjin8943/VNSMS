#include "localTCPConnect.h"
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <netdb.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#include <sys/wait.h>
#include <string.h>
#include <iostream>

int localTCPConnect::sendMessage(std::string server, std::string message)
{
	int yes=1;
	int status = 0;
	int sock = 0;
	struct addrinfo hints;
	struct addrinfo *res, *target; //points to results

	memset(&hints, 0, sizeof hints); //hints is empty
	hints.ai_family = AF_UNSPEC; //IPv4 or v6
	hints.ai_socktype = SOCK_STREAM; //TCP
	hints.ai_flags = AI_PASSIVE; //autofill IP addr

	printf("\n\n\n");
	
	if ((status = getaddrinfo(server.c_str(), "22061", &hints, &res)) != 0) 
	{
    		fprintf(stderr, " getaddrinfo error: %s\n", gai_strerror(status));
    		return -1;
	}
	for(target = res; target != NULL; target=target->ai_next)	{
		if((sock = socket(target->ai_family, target->ai_socktype, target->ai_protocol))==-1)
		{
			printf(" Error creating socket! \n");
			perror("socket: ");
			continue;
		}
		
		if(connect(sock,target->ai_addr,target->ai_addrlen) == -1)
		{
			close(sock);
			perror("connect");
			continue;
		}
		break;
	}
	if(target == NULL)
	{
		printf("remote server failed to connect \n");
		return -1;
	}
	char* ip4;
	ip4 = (char*) malloc(64);
	struct sockaddr_in ipv4;
	socklen_t salength = sizeof(ipv4);
	if(getsockname(sock,(struct sockaddr*)&ipv4,&salength)==-1)
	{
		perror("getsockname");
	}
	void* addr;
	int portNumber;
	portNumber = ntohs(ipv4.sin_port);
	addr= &(ipv4.sin_addr);
	inet_ntop(target->ai_family,addr, ip4, target->ai_addrlen);
	printf("remote server has TCP port number %i and IP address %s\n",portNumber,ip4);
	char *msg;
	msg = (char*) malloc(message.size());
	int length = message.size();
	msg =  &message[0];
	int bytes_sent=0;
	//std::cout<<"Sending message...\n";
	bytes_sent = send(sock, msg, length, 0);
	if(bytes_sent == -1)
	{
		perror("send");
		return -1;
	}
	message = std::string("the remote server has sent '")+message+std::string("' to '")+server+std::string("'\n\n\n");
	std::cout << message << std::endl;
	close(sock);
	return 0;
}





