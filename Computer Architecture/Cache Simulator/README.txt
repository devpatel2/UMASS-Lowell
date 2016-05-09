Devang Patel
E1

For this assignment we are to simulate a cache, and print out whether it was a 
hit or miss. There were 4 parts all together within this assignment. The first 
2 parts were similiar in nature, expect that second required us to input cache 
parameters from an input file. The 3rd part involved set associativity, while 
the 4th furthered the program to include LRU.

I started the assignment with part 1. I had to figure out how to create a cache 
rerepresentation, and how I would go about simulating the process. Once 
accomplished, I added the stdin requirement needed for part 2. After, which I 
worked on part 3 and 4 at the same time. They are similiar expect for the fact 
that when using LRU, the least recent tag is evicted, instead of a fixed line 
within a set. 

There does not seem to be any problems left that I have noticed. 

For the assignments, I deserve:

Part 1 : 1
Part 2 : 1
Part 3 : 1
Part 4 : 1

I have used the set associativity example of the class slides for my input for 
the simulation.

I believe that if I have gotten the cache to simulate set associativity 
involving multiple sets and lines, I have accomplished the first 3 parts. The 
fourth part cannot be seen from just the test.out file, as output is only hit 
or miss. If you check my e1.c, I have included a timestamp parameter for a 
given line. When choosing which one to evict, the cache chooses the one with 
the earliest timestamp.

Furthernotes: I have not tested with larger cache sizes and addresses. 