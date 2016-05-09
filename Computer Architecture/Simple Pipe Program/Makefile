all: a7 test.diff

test.diff: test.actual test.out
	diff -u test.out test.actual | tee test.diff

test.actual: a7
	./a7 > test.actual

a7: a7.c
	gcc a7.c -o a7

clean:
	rm -rf a7 test.actual