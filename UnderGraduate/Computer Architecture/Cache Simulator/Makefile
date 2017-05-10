all:e1 test.diff

test.diff:test.out test.actual
	diff -u test.out test.actual | tee test.diff

test.actual:e1
	./e1 < test.in > test.actual

e1:e1.c
	cc e1.c -o e1

clean:
	rm -rf e1 test.actual test.diff