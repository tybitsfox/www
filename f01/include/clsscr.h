#include&lt;stdio.h&gt;
#include&lt;string.h&gt;
#include&lt;ctype.h&gt;
#include&lt;stdlib.h&gt;
#include&lt;unistd.h&gt;
#include&lt;sys/types.h&gt;
#include&lt;sys/wait.h&gt;
#include&lt;sys/select.h&gt;   //use for select function
#include&lt;sys/time.h&gt;     //use for select function
#include&lt;sys/socket.h&gt;
#include&lt;sys/stat.h&gt;
#include&lt;sys/mman.h&gt;
#include&lt;netinet/in.h&gt;
#include&lt;arpa/inet.h&gt;
#include&lt;netdb.h&gt;
#include&lt;fcntl.h&gt;
#include&lt;netinet/tcp.h&gt;
#include&lt;errno.h&gt;
#include&lt;signal.h&gt;
#include&lt;ftw.h&gt;
#include&lt;dirent.h&gt;
//#include&lt;mysql/mysql.h&gt;
#include&lt;stdarg.h&gt;
//IPC USED
#include&lt;sys/ipc.h&gt;
#include&lt;sys/msg.h&gt;
#include&lt;sys/shm.h&gt;
#include&lt;syslog.h&gt;
//ptrace use
#include&lt;sys/ptrace.h&gt;
#include&lt;sys/user.h&gt;

#ifndef CLS_OWNE
#define CLS_OWNE		"\033[2J\033[1;1H"
#define CLS()			printf(CLS_OWNE)
#endif

#define max(a,b)         ((a)&gt;=(b)?(a):(b))
#define min(a,b)	 ((a)&gt;=(b)?(b):(a))

struct tsg_1
{
	char ch[20];
};
