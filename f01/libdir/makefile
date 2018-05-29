libaccsrc.so:accsrc.o
	gcc -g -shared -o libaccsrc.so accsrc.o
accsrc.o:accsrc.c
	gcc -c -fpic -o accsrc.o accsrc.c `pkg-config --cflags --libs gtk+-2.0`
install:
	cp ./libaccsrc.so /usr/lib/
	cp ./accsrc.h /usr/include/
clean:
	rm ./libaccsrc.so
	rm ./accsrc.o
	
