<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
echo "<hr size=2 width=80%>";
echo "struct sockaddr_in";
echo "<pre>在netinet/in.h中定义：
 struct sockaddr_in { 　　 
                             short int sin_family; /* 地址族 */
　　                         unsigned short int sin_port; /* 端口号 */ 　　 
                             struct in_addr sin_addr;/* IP地址 */ 　　
                             unsigned char sin_zero[8]; /* 填充0 以保持和struct sockaddr同样大小*/ 　　
                            };</pre> ";
echo "<hr size=2 width=80%>";
echo "struct sockaddr";
echo "<pre>
structsockaddr结构类型是用来保存socket信息的：
struct sockaddr { 
              unsigned short    sa_family; /* 地址族， AF_xxx */ 
              char sa_data[14]; /* 14 字节的协议地址 */ 
               };
　　          sa_family一般为AF_INET，代表Internet（TCP/IP）地址族；
              sa_data则包含该socket的IP地址和端口号。
</pre>";
echo "<hr size=2 width=80%>";
echo "struct in_addr:<pre>";
echo "
struct in_addr {
unsigned long s_addr;
};
typedef struct in_addr {
union {
            struct{
                        unsigned char s_b1,
                        s_b2,
                        s_b3,
                        s_b4;
                 } S_un_b;
           struct {
                        unsigned short s_w1,
                        s_w2;
                  } S_un_w;
            unsigned long S_addr;
          } S_un;
} IN_ADDR;
</pre>";
echo "<hr size=2 width=80%>";
echo "struct hostent:<pre>
　　 struct hostent {
　　 char *h_name;
　　 char **h_aliases;
　　 int h_addrtype;
　　 int h_length;
　　 char **h_addr_list;
　　 };
　　 #define h_addr h_addr_list[0]  
这里是这个数据结构的详细资料：  
struct hostent:  
　　h_name – 地址的正式名称。
　　h_aliases – 空字节-地址的预备名称的指针。
　　h_addrtype –地址类型; 通常是AF_INET。  
　　h_length – 地址的比特长度。
　　h_addr_list – 零字节-主机网络地址指针。网络字节顺序。
　　h_addr - h_addr_list中的第一地址。 
</pre>";
?>
