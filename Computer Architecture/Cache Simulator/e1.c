#include <stdio.h>
#include <stdlib.h>
#include <time.h>

typedef struct {
 int valid;
 int tag;
 time_t time;
} line_struct;

typedef struct {
 line_struct *lines;
} set_struct;

typedef struct {
 set_struct *sets;
} cache_struct;

int main(int argc, char* argv[]) {
 int size_address;
 int num_sets;
 int num_lines;
 int block_size;
 char add_line[10];
 int i, j, z, found, stored, min_time_index, found_index;
  int tag_length, k, tag, tag_total;
 int set, set_total, set_length;
 time_t min_time;

 scanf("%d %d %d %d", &size_address, &num_sets, &num_lines, &block_size);

 cache_struct cache;
 cache.sets = malloc(num_sets * sizeof(set_struct));
 for (i = 0; i < num_sets; i++) {
  cache.sets[i].lines = malloc(num_lines * sizeof(line_struct));
  for (j = 0; j < num_lines; j++) {
   cache.sets[i].lines[j].valid = 0;
   cache.sets[i].lines[j].tag = -1;
   cache.sets[i].lines[j].time = time(NULL);
  }
 }

 fgetc(stdin);
 scanf("%s", &add_line);
 tag_length = size_address - (num_sets / 2) - block_size;
 set_length = size_address - block_size - tag_length;

 while (add_line[0] != 'q') {
  tag = set = 1;
  tag_total = set_total = found = stored = 0;
  min_time = time(NULL);

  for (j = 0; j < tag_length; j++) {
   if (add_line[j] == '1') {
    if (tag_length == 1) {
     tag_total = 1;
    } else if (tag_length - 1 == 1) {
     tag_total = tag_total + 1;
    } else {
     for (k = j; k < tag_length -1; k++)
      tag = tag * 2;
     tag_total = tag_total + tag;
    }
   }
  }

  for (i = tag_length; i < size_address - block_size; i++) {
   if (add_line[i] == '1') {
    if (set_length == 1) {
     set_total = 1;
    }
    else if (set_length - 1 == 1) {
     set_total = set_total + 1;
    } else {
     for (k = i; k < size_address - block_size - 1; k++)
      set = set * 2;
     set_total = set_total + set;
    }
   }
  }

  for (i = 0; i < num_lines; i++) {
   if (cache.sets[set_total].lines[i].tag == tag_total)
    found = 1;
    found_index = i;
  }

  if (found == 1) {
   printf("Hit! :D\n");
   cache.sets[set_total].lines[found_index].time = time(NULL);
  }

  if (found == 0) {
   printf("Miss! :P\n");
   for (i = 0; i < num_lines; i++) {
    if (cache.sets[set_total].lines[i].valid == 0) {
     cache.sets[set_total].lines[i].tag = tag_total;
     cache.sets[set_total].lines[i].valid = 1;
     cache.sets[set_total].lines[i].time = time(NULL);
     stored = 1;
    }

    if (min_time > cache.sets[set_total].lines[i].time) {
     min_time = cache.sets[set_total].lines[i].time;
     min_time_index = i;
    }
   }

   if (stored == 0) {
    cache.sets[set_total].lines[min_time_index].tag = tag_total;
    cache.sets[set_total].lines[min_time_index].time = time(NULL);
   }
  }

  scanf("%s", &add_line);
  fgetc(stdin);
 }

return 0;
}