
<?php
session_start();
class Home extends Controller
{
	public function __construct(){
		parent::__construct();
		$this->p = new Paginator();
	}
	public function index(){
		$this->model = new Home_Model;
		$data=array();
		$data["new_products"] = $this->model->getNewProducts();
		$data["sale_products"] = $this->model->getSaleProducts();
		$data["news_list"] = $this->model->getNewsList();
		$data["category"] = $this->model->getCategory();
	
		$data['page']='shop/pages/home';
		$this->load->view("shop/index",$data);
	}
	public function details($id)
	{
		$data = array();
		$data["details"] = $this->model->getDetails($id);
		$data['page']='shop/pages/details';
		$this->load->view("shop/index",$data);
	}
	public function details_news($id)
	{
		$data = array();
		$data["news"] = $this->model->getNews($id);
		$data['page']='shop/pages/news';
		$this->load->view("shop/index",$data);
	}
	public function category($id,$page)
	{

		$cat = $this->model->getProductbyCategory($id) ;
		$n = count($cat);
		$config = array(
			'base_url'=>URL."index.php/home/category/$id/",
			'total_rows'=>$n,
			'per_page'=>6,
			'cur_page'=>$page
		);
		
		$this->p->init($config);
		$data = array();
		$data["category"] = $this->model->getCategory();
		$data['product_ed'] = $this->model->getDataCate($id,'products',$config['per_page'],$page) ;
		$data['paginator'] = $this->p->createLinks();
		$data["product_cate"] = $this->model->getProductbyCategory($id);
		$data['page']='shop/pages/category';
		$this->load->view("shop/index",$data);
	}
	public function register()
	{
		$data = array();
		$data['page']='shop/pages/register';
		$this->load->view("shop/index",$data);
	}
	public function postRegister()
	{
		$this->model->doRegister();
		header('Location:../home/index');
	}
	public function login()
	{
		if (isset($_SESSION['user'])){
			header('Location:../home/index');
		}
		else {
			$data = array();
		$data['page']='shop/pages/login';
		$this->load->view("shop/index",$data);
		}
		
	}
	public function postLogin()
	{
		$user=$this->model->doLogin();
		if (count($user)>0){
			if ($user['status']==1){
				header('Location:../home/lock');
			}
			else
			{
			$_SESSION['user'] = $user['name'];
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['role'] = $user['role'];
			header('Location:../home/index');
			}
		}
		else {
			$data['page']='shop/pages/login';
			$data["thongbao"] = "SAI T??I KHO???N M???T KH???U";
		$this->load->view("shop/index",$data);
		echo "Th???t b???i";
		}
		// header('Location:../home/index');
	}
	public function lock()
	{
		$data['page']='shop/pages/lock';
		$this->load->view("shop/index2",$data);
	}
	public function logout()
	{
	
		unset($_SESSION['user_id']);
		unset($_SESSION['role']);
		unset($_SESSION['user']);
		header('Location:../home/index');
	}
	public function cartview()
	{
		if (isset($_SESSION['cart'])){
			echo "???? c??";
		}
		$data['page']='shop/pages/cart';
		$this->load->view("shop/index",$data);
	}
	public function payment()
	{
		if (isset($_SESSION['user'])){
			$data['page']='shop/pages/payment';
			$this->load->view("shop/index",$data);
		}
		else{
			header('Location:'.URL.'index.php/home/login');
		}
	}
	public function deleteAllCart()
	{
		unset($_SESSION['cart']);
		$_SESSION['total']=0;
		header('Location:'.URL.'index.php/home/index');
	}
	public function cartplus($id){
		$_SESSION['cart'][$id]['quantity']++;
		$_SESSION['total']+=$_SESSION['cart'][$id]['price'];
		header('Location:'.URL.'index.php/home/cartview');
	}
	public function deleteOneCart($id)
	{
		$_SESSION['total']-=$_SESSION['cart'][$id]['price']*$_SESSION['cart'][$id]['quantity'];
		unset($_SESSION['cart'][$id]);

		header('Location:'.URL.'index.php/home/cartview');
	}
	public function cartunplus($id){
		$_SESSION['cart'][$id]['quantity']--;
		$_SESSION['total']-=$_SESSION['cart'][$id]['price'];
		if ($_SESSION['cart'][$id]['quantity']==0){
			unset($_SESSION['cart'][$id]);
			
		}
		header('Location:'.URL.'index.php/home/cartview');
		
	}
	public function addcart($id)
	{
		$data["details"] = $this->model->getDetails($id);
			$a = $data["details"];
			$name = $a['product_name'];
			if($a['sale']==1){
				$price = $a['price'] - ($a['price']*($a['saleprice']/100));
			}else{
				$price = $a['price'];
			}
			if (!isset($_SESSION['cart'])){
				$_SESSION['cart']=[];
				$_SESSION['total']=0;
			}
			if (isset($_SESSION['cart'][$id])){
				$_SESSION['cart'][$id]['quantity']++;
				$_SESSION['total']+=$price;
			}
			else{
				$_SESSION['total']+=$price;
				$_SESSION['cart'][$id]=[
					'id'=>$id,
					'product_name'=>$name,
					   'price'=>$price,
					   'quantity'=>1
							 ];
			}
			
			header('Location:'.URL.'index.php/home/index'); 
	}
	public function Ordercomplete(){
		if (isset($_SESSION['cart'])){
			$p=[];
		 $this->model->doOrder();
			$p['a'] = $this->model->getOrder();
			 $this->model->doDetailsOrder($p['a'][0]['id'],$_SESSION['cart']);
			 unset($_SESSION['cart']);
			 $_SESSION['total']=0;
			 header('Location:'.URL.'index.php/home/complete');
		}
	}
	public function complete(){
		$data=[];
		$data['page']='shop/pages/complete';
		$this->load->view("shop/index2",$data);
	}
	public function detailsUser()
	{
		$data = array();
		if (!isset($_SESSION['user'])){
			header('Location:'.URL.'index.php/home/login');
		}
		$data["detailUser"] = $this->model->getUser($_SESSION['user_id']);
		$_SESSION['user'] = $data["detailUser"]["name"];
		$data['page']='shop/pages/users';
		$this->load->view("shop/index",$data);
	}
	public function postchangeinfo()
	{
		$this->model->doUpdateUser($_SESSION["user_id"]);
		header('Location:'.URL.'index.php/home/detailsUser');
	}
	public function changepass()
	{
		$data['page']='shop/pages/changepass';
		$this->load->view("shop/index",$data);
	}
	public function postchangepass()
	{
		$ab = $this->model->checkPass($_SESSION['user_id'],$_POST['password']);
		$a=-1;
		$b=-1;
		if ($ab==""){
				$data['thongbao']="M???t kh???u c?? kh??ng ????ng";
				$data['page']='shop/pages/changepass';
				$this->load->view("shop/index",$data);
		}
		else
		{
			$a=0;
		}
		if ($_POST['newpassword']!=$_POST['passwordagain']){
				$data['thongbao']="Nh???p l???i m???t kh???u kh??ng ????ng";
				
				$data['page']='shop/pages/changepass';
				$this->load->view("shop/index",$data);
		}
		else{
			$b=0;
		}
		if($a==0 && $b ==0){
		$this->model->doUpdatePass($_SESSION['user_id'],$_POST['newpassword']);
		unset($_SESSION['user_id']);
		unset($_SESSION['role']);
		unset($_SESSION['user']);
		header('Location:../home/index');
		}
		
	}
	public function detailsUserOrder()
	{
		$data = array();
		if (!isset($_SESSION['user'])){
			header('Location:'.URL.'index.php/home/login');
		}
		$data["detailUserOrder"] = $this->model->getUserOrder($_SESSION['user_id']);
		if($data["detailUserOrder"]==NULL){
			$data['page']='shop/pages/userordernull';
			$this->load->view("shop/index",$data);
		}
		else{$data["detailUser"] = $this->model->getUser($_SESSION['user_id']);
			$_SESSION['user'] = $data["detailUser"]["name"];
			$data['page']='shop/pages/userorder';
			$this->load->view("shop/index",$data);}
		
	}
	function orderDetails($id)
	{
		$data['product'] = $this->model->getRecordByTrash('products',0);
		$data['order_details'] = $this->model->getOrderDetails('order_details',$id) ;
		$data['page'] = "shop/pages/orderdetails";
		$this->load->view("shop/index",$data);
	}
	function deleteOrder($id)
	{
		$this->model->deleteOrder($id);
		header('Location:'.URL.'index.php/home/detailsUserOrder');
	}
	public function newss()
	{
		$data["news_list"] = $this->model->getNewsListfull();
		$data['page']='shop/pages/newss';
		$this->load->view("shop/index",$data);

	}
	public function sale()
	{
		$data["sale_products"] = $this->model->getSaleProductsall();
		$data['page']="shop/pages/sale";
		$this->load->view("shop/index",$data);

	}
	public function search()
	{
		$data["search"] = $this->model->search();
		$data['page']="shop/pages/search";
		$this->load->view("shop/index",$data);
		
	}
}
?>