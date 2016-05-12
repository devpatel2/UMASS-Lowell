#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/wait.h>
#include <signal.h>

void part2 (int sig) {
 execl("./a1", "a1", NULL);
}

int main (int argc, char* argv[]) {

pid_t child;
int status;
int pipes[2];
char string[] = "Read from child\n";
char readbuffer[50];

if (argv[1] == NULL) {
 printf("PARENT2: About to perform step # 1\n");
 printf("PARENT2: Process ID is:            %d\n", getpid());
 printf("PARENT2: Process parent ID is:     %d\n", getppid());
 printf("PARENT2: Real UID is:              %d\n", getuid());
 printf("PARENT2: Real GID is:              %d\n", getgid());
 printf("PARENT2: Effective UID is:         %d\n", geteuid());
 printf("PARENT2: Effective GID is:         %d\n", getegid());
 printf("PARENT2: Process priority is:      %d\n", getpriority());
 
 exit(0);
} else {
 printf("PARENT: About to perform step # 1\n");
 printf("PARENT: Process ID is:            %d\n", getpid());
 printf("PARENT: Process parent ID is:     %d\n", getppid());
 printf("PARENT: Real UID is:              %d\n", getuid());
 printf("PARENT: Real GID is:              %d\n", getgid());
 printf("PARENT: Effective UID is:         %d\n", geteuid());
 printf("PARENT: Effective GID is:         %d\n", getegid());
 printf("PARENT: Process priority is:      %d\n", getpriority());

 printf("PARENT: About to perform step # 2\n");
 pipe(pipes);

 printf("PARENT: About to perform step # 3\n");
 child = fork();

 if (child == -1) {
  perror("Fork Failed\n");
  exit (1);
 }

 if (child == 0) {                                                                                     // child process
  printf("CHILD: About to perform step # 1\n");
  printf("CHILD: Process ID is:            %d\n", getpid());
  printf("CHILD: Process parent ID is:     %d\n", getppid());
  printf("CHILD: Real UID is:              %d\n", getuid());
  printf("CHILD: Real GID is:              %d\n", getgid());
  printf("CHILD: Effective UID is:         %d\n", geteuid());
  printf("CHILD: Effective GID is:         %d\n", getegid());
  printf("CHILD: Process priority is:      %d\n", getpriority());
  
  printf("CHILD: About to perform step # 2\n");
  struct sigaction handler;
  handler.sa_handler = part2;
  sigaction(SIGTERM, &handler, NULL);
  
  printf("CHILD: About to perform step # 3\n");
  printf("CHILD: Writing To Pipe\n");
  write(pipes[1], string, (sizeof(string) + 1));
  
  printf("CHILD: About to perform step # 4\n");
  while(1) {}
  
  } else {                                                                                                     // parent process
  printf("PARENT: About to perform step # 4\n");
  read(pipes[0], readbuffer, sizeof(readbuffer));
  printf("PARENT: Reading From Pipe: %s", readbuffer);
 
  printf("PARENT: About to perform step # 5\n");
  kill(child, SIGTERM);
  
  printf("PARENT: About to perform step # 6\n");
  wait(&status);
  printf("PARENT: CHILD exited with status %d\n", WTERMSIG(status)); 
 
  printf("PARENT: About to perform step # 7\n");
  exit(0);
  }
}
return 0;
}