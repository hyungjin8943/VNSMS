#include <string>
#include <iostream>
#include <istream>
#include "localTCPConnect.h"

#define SERVER "dbloznalis.com"

//for solaris compile:
////g++ localmain.cpp localTCPConnect.cpp -o local.out -lsocket -lnsl -lresolv
int main(int argc, char** argv)
{
    localTCPConnect local;
    std::string message;
    std::string serverString(SERVER);
    if(argc == 1){
	std::cout<<"\n Enter the message you would like to send: ";
	std::getline(std::cin,message);
    }else{
        for(int i = 1; i < argc; i++){
	    message.append(argv[i]);
	    if(i > 3){
		message.append(" ");
	    }
        }
    }
    local.sendMessage(serverString,message);
    return 0;
}
