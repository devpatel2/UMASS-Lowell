all: a4 test

test: a4
	./a4 30 rand 4 50 200 31000

a4: a4.c
	cc a4.c -o a4 -pthread

clean:
	rm -f a4