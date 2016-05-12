#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>

main (int argc, char* argv[]) {

pid_t child;
int status;
int pipes[2];
char string[] = "Read from parent\n";
char readbuffer[50];

printf("PARENT: About to perform step # 1\n");
printf("PARENT: Process ID is:            %d\n", getpid());
printf("PARENT: Process parent ID is:     %d\n", getppid());
printf("PARENT: Real UID is:              %d\n", getuid());
printf("PARENT: Real GID is:              %d\n", getgid());
printf("PARENT: Effective UID is:         %d\n", geteuid());
printf("PARENT: Effective GID is:         %d\n", getegid());
printf("PARENT: Process priority is:      %d\n", getpriority());

printf("\nPARENT: About to perform step # 2\n");
pipe(pipes);
printf("PARENT: Pipe Created\n\n");

printf("PARENT: About to perform step # 3\n");
printf("PARENT: Creating Child\n");
child = fork();

if (child == -1) {
 perror("Fork Failed\n");
 exit (1);
}

if (child == 0) {                                                                                     // child process
 printf("\nCHILD: About to perform step # 1\n");
 printf("CHILD: Process ID is:            %d\n", getpid());
 printf("CHILD: Process parent ID is:     %d\n", getppid());
 printf("CHILD: Real UID is:              %d\n", getuid());
 printf("CHILD: Real GID is:              %d\n", getgid());
 printf("CHILD: Effective UID is:         %d\n", geteuid());
 printf("CHILD: Effective GID is:         %d\n", getegid());
 printf("CHILD: Process priority is:      %d\n", getpriority());
 
 close(pipes[1]);
 printf("\nCHILD: About to perform step # 2\n");
 read(pipes[0], readbuffer, sizeof(readbuffer));
 printf("CHILD: Reading From Pipe: %s\n", readbuffer);
 
 printf("CHILD: About to perform step # 3\n");
 printf("CHILD: Parent Process ID is %d\n", getppid());
 
 printf("\nCHILD: About to perform step # 4\n");
 printf("CHILD: Exit With Success\n");
 } else {                                                                                            // parent process
 close(pipes[0]);
 printf("\nPARENT: About to perform step # 4\n");
 printf("PARENT: Writing To Pipe\n");
 write(pipes[1], string, (sizeof(string) + 1));
 
 wait(&status);

 printf("\nPARENT: About to perform step # 5\n");
 printf("PARENT: Exit With Success\n");
 exit(0);
 }

return 0;
}