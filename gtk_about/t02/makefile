libxx01.so:f01.o
	gcc -shared -o libxx01.so f01.o
f01.o:f01.c
	gcc -c -fpic -o f01.o f01.c `pkg-config --cflags --libs gtk+-2.0` -I/workarea/cprogram/include/
install:
	cp libxx01.so /workarea/cprogram/mlib/mgtk/
clean:
	rm *.o *.so

