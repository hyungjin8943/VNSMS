#include <string>

class remoteTCPConnect
{
private:
	int mainSockID;
	bool disconnect;
	int setupSocket();
public:
	remoteTCPConnect();
	int setup(int receiveBufferLength);
	int tearDown();
	int parse(std::string message);
};
