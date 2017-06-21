<?php

/**
 * ���ã�FTP������( �������ƶ���ɾ���ļ�/����Ŀ¼ )
 */

class class_ftp
{
	public $off; // ���ز���״̬(�ɹ�/ʧ��)
	public $conn_id; // FTP����
	const FTP_HOST='*.*.*.*';
	const FTP_PORT='21';
	const FTP_USER='*******';
	const FTP_PASS='*******';

	/**
	* ������FTP����
	* @FTP_HOST -- FTP����
	* @FTP_PORT -- �˿�
	* @FTP_USER -- �û���
	* @FTP_PASS -- ����
	*/
	function __construct()
	{
	$this->conn_id = @ftp_connect(self::FTP_HOST,self::FTP_PORT) or die("FTP����������ʧ��");
	@ftp_login($this->conn_id,self::FTP_USER,self::FTP_PASS) or die("FTP��������½ʧ��");
	@ftp_pasv($this->conn_id,1); // �򿪱���ģ��
	}
	
	/**
	* �������ϴ��ļ�
	* @path -- ����·��
	* @newpath -- �ϴ�·��
	* @type -- ��Ŀ��Ŀ¼���������½�
	 */
	 function up_file($path,$newpath,$type=true)
	 {
	 var_dump($this->conn_id);exit;
	 if($type) $this->dir_mkdirs($newpath);
	 $this->off = @ftp_put($this->conn_id,$newpath,$path,FTP_BINARY);
	 if(!$this->off) echo "�ļ��ϴ�ʧ�ܣ�����Ȩ�޼�·���Ƿ���ȷ��";
	 }
	 /**
	 * �������ƶ��ļ�
	 * @path -- ԭ·��
	 * @newpath -- ��·��
	 * @type -- ��Ŀ��Ŀ¼���������½�
     */
	 function move_file($path,$newpath,$type=true)
	 {
	 if($type) $this->dir_mkdirs($newpath);
	 $this->off = @ftp_rename($this->conn_id,$path,$newpath);
	 if(!$this->off) echo "�ļ��ƶ�ʧ�ܣ�����Ȩ�޼�ԭ·���Ƿ���ȷ��";
	 }
	 /**
	 * �����������ļ�
	 * ˵��������FTP�޸�������,��������ͨ����Ϊ�����غ����ϴ����µ�·��
	 * @path -- ԭ·��
	 * @newpath -- ��·��
	 * @type -- ��Ŀ��Ŀ¼���������½�
	 */
	 function copy_file($path,$newpath,$type=true)
	 {
	 $downpath = "c:/tmp.dat";
	 $this->off = @ftp_get($this->conn_id,$downpath,$path,FTP_BINARY);// ����
	 if(!$this->off) echo "�ļ�����ʧ�ܣ�����Ȩ�޼�ԭ·���Ƿ���ȷ��";
	 $this->up_file($downpath,$newpath,$type);
	 }
	 /**
	 * ������ɾ���ļ�
	 * @path -- ·��
	 */
	 function del_file($path)
	 {
	 $this->off = @ftp_delete($this->conn_id,$path);
	 if(!$this->off) echo "�ļ�ɾ��ʧ�ܣ�����Ȩ�޼�·���Ƿ���ȷ��";
	 }
	 /**
	 * ����������Ŀ¼
	 * @path -- ·��
	 */
	 function dir_mkdirs($path)
	 {
	 $path_arr = explode('/',$path); // ȡĿ¼����
	 $file_name = array_pop($path_arr); // �����ļ���
	 $path_div = count($path_arr); // ȡ����
	 foreach($path_arr as $val) // ����Ŀ¼
	  {
	  if(@ftp_chdir($this->conn_id,$val) == FALSE)
	  {
	  $tmp = @ftp_mkdir($this->conn_id,$val);
	  if($tmp == FALSE)
	  {
	  echo "Ŀ¼����ʧ�ܣ�����Ȩ�޼�·���Ƿ���ȷ��";
	  exit;
	 }
	 @ftp_chdir($this->conn_id,$val);
	 }
	 }
	 for($i=1;$i=$path_div;$i++) // ���˵���
	 {
	 @ftp_cdup($this->conn_id);
	 }
	 }
	 /**
	 * �������ر�FTP����
	 	*/
	 		function close()
	 		{
	 		@ftp_close($this->conn_id);
	 }
	 }// class class_ftp end
	 
	 /************************************** ���� ***********************************
	 $ftp = new class_ftp('192.168.100.143',21,'user','pwd'); // ��FTP����
	 //$ftp->up_file('aa.txt','a/b/c/cc.txt'); // �ϴ��ļ�
	 //$ftp->move_file('a/b/c/cc.txt','a/cc.txt'); // �ƶ��ļ�
	 //$ftp->copy_file('a/cc.txt','a/b/dd.txt'); // �����ļ�
	 //$ftp->del_file('a/b/dd.txt'); // ɾ���ļ�
	 $ftp->close(); // �ر�FTP����
	 ******************************************************************************/
