void empty_rc();//初始化前置空结构体TAG_RC_FARM,保证所有指针为NULL
int get_rc();//读取默认的配置文件。
int verf_rc();//测试配置文件指定的图片是否存在
void free_rc();//释放分配的内存
int alloc_msg_buf();//分配信息栏缓冲，并初始化相关指针
//每个结构进行独立的资源分配、验证、释放的好处就是便于查错:
int seed_rc();//商店资源的分配
void seed_free();//商店资源的释放
int verf_seed_rc();//验证所有资源的初始化
void free_seed_rc();//释放商店资源
int harvest_rc();//仓库资源分配-修改，将该结构放置tag_player_p中
int verf_harvest_rc();//仓库资源验证－同上
void free_harvest_rc();//仓库资源的释放－同上，直接对tag_player_p操作
int load_record();//提取记录,成功返回0，新纪录返回1
void save_record();//保存记录 默认文件名：./farm.sav




