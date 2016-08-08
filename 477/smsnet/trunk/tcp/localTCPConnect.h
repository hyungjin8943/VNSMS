#include <string>

class localTCPConnect
{
private:
	std::string serverName;
public:
	/*void setServerName(std::string server);
	std::string getServerName();
	int send(std::string message);*/
	int sendMessage(std::string server, std::string message);
};
