#!/usr/bin/env python
#-*- coding:utf-8 -*-
import time
import threading
import socketserver 
import pymysql

def main():
    db= pymysql.connect(host="localhost",user="root",password="950808",db="vmbm",port=3306)  
  
 	# 使用cursor()方法获取操作游标  
    cur = db.cursor()  
      
    #1.查询操作  
    # 编写sql 查询语句  user 对应我的表名  
    sql = "select * from fans"  
    try:  
        cur.execute(sql)    #执行sql语句  
      
        results = cur.fetchall()    #获取查询的所有记录  
        print("id","wechat_id","wechat_name")  
        #遍历结果  
        for row in results :  
            id = row[0]  
            wechat_id = row[1]  
            wechat_name = row[2]  
            print(id,wechat_id,wechat_id)  
    except Exception as e:  
        raise e  
    finally:  
        db.close()  #关闭连接  



if __name__ == "__main__":
    # do the UNIX double-fork magic, see Stevens' "Advanced
    # Programming in the UNIX Environment" for details (ISBN 0201563177)
    # try:
    #     pid = os.fork()
    #     if pid > 0:
    #         # exit first parent
    #         sys.exit(0)
    # except OSError, e:
    #     print >>sys.stderr, "fork #1 failed: %d (%s)" % (e.errno, e.strerror)
    #     sys.exit(1)
    # # decouple from parent environment
    # os.chdir("/")
    # os.setsid()
    # os.umask(0)
    # # do second fork
    # try:
    #     pid = os.fork()
    #     if pid > 0:
    #         # exit from second parent, print eventual PID before
    #         print "Daemon PID %d" % pid
    #         sys.exit(0)
    # except OSError, e:
    #     print >>sys.stderr, "fork #2 failed: %d (%s)" % (e.errno, e.strerror)
    #     sys.exit(1)
    # start the daemon main loop
    main()