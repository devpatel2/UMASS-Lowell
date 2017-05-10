#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <pthread.h>
#include <semaphore.h>
#include <fcntl.h>
#include <sys/stat.h>

int c;
int PC, DC, CC, DDC, QS;
char *PM;
struct ring_buffer *donut_type;
pthread_mutex_t p_lock;
pthread_mutex_t c_lock;
pthread_cond_t p_cond;
pthread_cond_t c_cond;

struct ring_buffer {
 int *donut_queue;
 int in;
 int out;
 int counter;
 int space;
 int donuts;
};

void* producer(void* arg) {
 int j;
 if(strcmp(PM, "in-order") == 0)
  j = 0;
 else
  j = rand() % DC;
 
 while(1) {
  pthread_mutex_lock(&p_lock);
  while(donut_type[j].space <= 0)
   pthread_cond_wait(&p_cond, &p_lock);
  
  donut_type[j].donut_queue[donut_type[j].in] = donut_type[j].counter;
  donut_type[j].in = (donut_type[j].in + 1) % QS;
  donut_type[j].counter++;
  
  if(strcmp(PM, "in-order") == 0)
   j = (j + 1) % DC;
  else
   j = rand() % DC;
  
  donut_type[j].space--;
  donut_type[j].donuts++;
  pthread_mutex_unlock(&p_lock);
  pthread_cond_signal(&p_cond);
 }
 pthread_exit(NULL);
}

void* consumer(void* arg) {
 int donuts[12];
 int type[12];
 int i, j, k, m, c_num;
 c_num = c++;
 
 if(strcmp(PM, "in-order") == 0)
  j = 0;
 else
  j = rand() % DC;
 
 for(i = 0; i < DDC; i++) {
  for(k = 0; k < 12; k++) {
   pthread_mutex_lock(&c_lock);
   while(donut_type[j].donuts <= 0)
    pthread_cond_wait(&c_cond, &c_lock);
   
   donuts[k] = donut_type[j].donut_queue[donut_type[j].out];
   type[k] = j;
   donut_type[j].out = (donut_type[j].out + 1) % QS;
   
   if(strcmp(PM, "in-order") == 0)
    j = (j + 1) % DC;
   else
    j = rand() % DC;
   
   donut_type[j].donuts--;
   donut_type[j].space++;
   pthread_mutex_unlock(&c_lock);
   pthread_cond_signal(&c_cond);
  }
  
  printf("(yum %d %d ( ",  c_num, i);
  for(m = 0; m < 12; m++) {
   printf("[%d %d] ", type[m], donuts[m]);
  }
  printf(") )\n");
 }
 pthread_exit(NULL);
}

int main(int argc, char* argv[]) {
 if(argc != 7) {
  printf("Missing command line args -- ./a4 [PC] [PM] [DC] [CC] [DDC] [QS]\n");
  exit(1);
 }
 c = 0;
 int i, fail;
 
 PC = atoi(argv[1]);
 PM = argv[2];
 DC = atoi(argv[3]);
 CC = atoi(argv[4]);
 DDC = atoi(argv[5]);
 QS = atoi(argv[6]);
 
 pthread_mutex_init(&p_lock, 0);
 pthread_mutex_init(&c_lock, 0);
 pthread_cond_init(&p_cond, 0);
 pthread_cond_init(&c_cond, 0);
 
 struct ring_buffer arr[DC];
 pthread_t prod[PC];
 pthread_t con[CC];
 
 for(i = 0; i < DC; i++) {
  struct ring_buffer rb;
  rb.donut_queue = (int*)malloc(QS * sizeof(int));
  rb.in = 0;
  rb.out = 0;
  rb.counter = 1;
  rb.space = QS;
  rb.donuts = 0;
  arr[i] = rb;
 }
 
 donut_type = arr;
 
 for(i = 0; i < PC; i++) {
  fail = pthread_create(&(prod[i]), NULL, &producer, NULL);
  if(fail != 0) {
   perror("producer pthread create failed -- ");
   exit(1);
  }
 }
 
 for(i = 0; i < CC; i++) {
  fail = pthread_create(&(con[i]), NULL, &consumer, NULL);
  if(fail != 0) {
   perror("consumer pthread create failed -- ");
   exit(1);
  }
 }
 
 for(i = 0; i < CC; i++) {
  pthread_join(con[i], NULL);
 }
 
 for(i = 0; i < PC; i++) {
  pthread_cancel(prod[i]);
 }
 
 pthread_cond_destroy(&p_cond);
 pthread_cond_destroy(&c_cond);
 pthread_mutex_destroy(&p_lock);
 pthread_mutex_destroy(&c_lock);
 
 return 0;
}