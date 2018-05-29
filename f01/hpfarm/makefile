libhappyfm.so:happyfm.o
	gcc -g -shared -o libhappyfm.so happyfm.o
happyfm.o:happyfm.c
	gcc -c -fpic -o happyfm.o happyfm.c `pkg-config --cflags --libs gtk+-2.0`
install:
	cp ./libhappyfm.so /workarea/cprogram/mlib/
	cp ./happyfm.h /workarea/cprogram/mlib/include/
clean:
	rm ./libhappyfm.so
	rm ./happyfm.o

