<?php 
#snippet of prevoius work source codes

#HRM SOLUTION

#Controller method to apply a perfomance indicator to  appraise an employee

# employee details method.
public function get_emp_desg($emp){
		$this->db->where('user_id',$emp);
$query=$this->db->get('employees');
$row=$query->row_array();
return $row["designation_id"];
	}
#Performance Rating method.
	public function rating($rating){
	
		if($rating =="1"){
			$value ="Beginner";
		}elseif($rating =="2"){
			$value ="Intermediate";
		}
		elseif($rating =="3"){
			$value ="Advanced";
		}
		elseif($rating =="4"){
			$value ="Expert / Leader";
		}else{
			$value ="Not Set";
		}
		return $value;
	}
#Get performance indicator method and apply to employee as apprasial 
	public function get_indicator()
	{
#get employeeid	as post
 $emp=$this->input->post('employee_id');

 #get designation id from employee details method 
 $desigid=$this->get_emp_desg($emp);

 #get performance indicator data using employee designation id from table performance_indicator
	$this->db->where('designation_id', $desigid);
	$query=$this->db->get('performance_indicator');
	$rows=$query->num_rows();

#if found proceed
if($rows == 1 ){
	$out=$query->row_array();

	 $pdesig=$out["designation_id"];

	if($desigid == $pdesig){
		$res=$query->result();

#output all data rows
		foreach($res as $val){
 $c=$val->customer_experience;
 $m=$val->marketing;
 $ma=$val->management;
 $a=$val->administration;
 $p=$val->presentation_skill;
 $q=$val->quality_of_work;
 $e=$val->efficiency;

 $in=$val->integrity;
 $pro=$val->professionalism;
 $tw=$val->team_work;
 $ct=$val->critical_thinking;
 $cm=$val->conflict_management;
 $at=$val->attendance;
 $dd=$val->ability_to_meet_deadline;


#echo output into view using jquery get
echo'
<div class="col-md-6">
<div class="box bg-white">
  <table class="table table-grey-head m-md-b-0">
	<thead>
	  <tr>
		<th colspan="5">Technical Competencies</th>
	  </tr>
	</thead>
	<tbody >
<tr>
<th colspan="2">Indicator</th>
<th colspan="2">Expected Value</th>
<th>Set Value</th>
</tr>
<tr>
                      <td scope="row" colspan="2">Customer Experience </td>
                      <td colspan="2" id="cus">'.$this->rating($c).'</td>
                      <td><select name="customer_experience" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Marketing </td>
                      <td colspan="2">'.$this->rating($m).'</td>
                      <td><select name="marketing" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Management </td>
                      <td colspan="2">'.$this->rating($ma).'</td>
                      <td><select name="management" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Administration </td>
                      <td colspan="2">'.$this->rating($a).'</td>
                      <td><select name="administration" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Presentation Skill </td>
                      <td colspan="2">'.$this->rating($p).'</td>
                      <td><select name="presentation_skill" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Quality Of Work </td>
                      <td colspan="2">'.$this->rating($q).'</td>
                      <td><select name="quality_of_work" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td scope="row" colspan="2">Efficiency </td>
                      <td colspan="2">'.$this->rating($e).'</td>
                      <td><select name="efficiency" class="form-control">
                          <option value="">None</option>
                          <option value="1"> Beginner</option>
                          <option value="2"> Intermediate</option>
                          <option value="3"> Advanced</option>
                          <option value="4"> Expert / Leader</option>
                        </select></td>
                    </tr>
					</tbody>
					</table>
				  </div>
				</div>
				<div class="col-md-6">
				  <div class="box bg-white">
					<table class="table table-grey-head m-md-b-0">
					  <thead>
						<tr>
						  <th colspan="5">Behavioural / Organizational Competencies</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <th colspan="2">Indicator</th>
						  <th colspan="2">Expected Value</th>
						  <th>Set Value</th>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Integrity</td>
						  <td colspan="2">'.$this->rating($in).'</td>
						  <td><select name="integrity" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Professionalism</td>
						  <td colspan="2">'.$this->rating($pro).'</td>
						  <td><select name="professionalism" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Team Work</td>
						  <td colspan="2">'.$this->rating($tw).'</td>
						  <td><select name="team_work" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Critical Thinking</td>
						  <td colspan="2">'.$this->rating($ct).'</td>
						  <td><select name="critical_thinking" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Conflict Management</td>
						  <td colspan="2">'.$this->rating($cm).'</td>
						  <td><select name="conflict_management" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Attendance</td>
						  <td colspan="2">'.$this->rating($at).'</td>
						  <td><select name="attendance" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
						<tr>
						  <td scope="row" colspan="2">Ability To Meet Deadline</td>
						  <td colspan="2">'.$this->rating($dd).'</td>
						  <td><select name="ability_to_meet_deadline" class="form-control">
							  <option value="">None</option>
							  <option value="1"> Beginner</option>
							  <option value="2"> Intermediate</option>
							  <option value="3"> Advanced</option>
							</select></td>
						</tr>
					  </tbody>
					</table>
				  </div>
				</div>
';
		}

	}
}
	}
#end 


#Elearning Enrollment and Quiz methods

#enrollment controller
 public function enroll($id,$price)
    {
        $date = date("Y-m-d h:i:s");

        #Payment model
      $check_payment=$this->Dashboard_Model->get_payment_status($id);

        foreach($check_payment as $stats) {
            $status = $stats->status;
        }
          if($status == "paid"){
              redirect('dashboard/take_course/'.$id);
          }else{

              $acid=$this->session->userdata('accountid');

              $data1= array(

                  'accountid'=>$acid,
                  'courseid'=>$id

              );
              $this->db->where($data1);
              $query = $this->db->get('tbl_cart');
              $rows = $query->num_rows();
              if($rows > 0){
                  $type = "error";
                  $message = "Error! You already enroll for this course";
                  set_message($type, $message);
                  redirect('dashboard/course_details/'.$id);
              }else {
                  $data = array(

                      'accountid' => $acid,
                      'courseid' => $id,
                      'price' => $price,
                      'datecreated' => $date
                  );
                  $query = $this->db->insert('tbl_cart', $data);
                  if ($query) {

                      redirect('dashboard/cart');
                  }
              }
        }
    }
    public function take_quiz($cid,$lid,$tid =null)
    {
        if(empty($tid)){
         $results = $this->Dashboard_Model->get_lesson_details($lid);
            //var_dump($results);
            foreach ($results as $data1) {
                  $time = $data1->duration;
                $data["time"] = $time;
            }
            $data["title"] = "Assessment";
            $data["total"]=$this->Dashboard_Model->get_quiz_total($cid);
            $data["results"]=$this->Dashboard_Model->get_quiz_details($cid);
            $this->load->view('students/take_quiz', $data);
        }else{
            $results = $this->Dashboard_Model->get_lesson_details($lid);
            foreach ($results as $data1) {
                $time = $data1->duration;
                $data["time"] = $time;
            }
            $data["title"] = "Assessment";
            $data["total"] =$this->Dashboard_Model->get_quiz_total($cid);
            $data["results"]=$this->Dashboard_Model->get_quiz_details($cid,$tid);
            $this->load->view('students/take_quiz', $data);
        }

    }
    public function lesson_quiz($id,$cid)
    {

        if(empty($id)){

            redirect('dashboard/my_courses');
        }else{
            $acid=$this->session->userdata('accountid');
            $check=$this->Dashboard_Model->check_quiz_taken($id,$acid);
           $lno = $this->Dashboard_Model->get_total_lesson($cid);
           $mno = $this->Dashboard_Model->get_module_no($cid);
            $qtype = $this->Dashboard_Model->get_quiz_type($id,$cid);
            $lno2 = $lno - 1;

            if($check > 0){
                redirect('dashboard/quiz_result');
            }else{
                if(($qtype == "Final Assessment") && ($lno2 != $mno)){

                        $value["title"] = "Notice";
                        $value["course_title"] = $this->Dashboard_Model->get_course_title($cid);
                        $value["cid"] = $cid;
                        $this->load->view('students/message', $value);

                }else {
                    $time = $this->Dashboard_Model->get_quiz_time($id, $cid);

                    $data["time"] = $time;
                    $data["lid"] = $id;
                    $data["cid"] = $cid;
                    $data["title"] = "Assessment";
                    $data["total"] = $this->Dashboard_Model->get_quiz_total2($id, $cid);
                    $data["results"] = $this->Dashboard_Model->get_quiz_details2($id, $cid);
                    $data["activelesson"] = $this->Dashboard_Model->get_quiz_details2($id, $cid);
                    $this->load->view('students/lesson_quiz', $data);
                }
            }

        }

    }
    public function save_lesson_quiz()
    {
        $acid=$this->session->userdata('accountid');
        $queid=$this->input->post('queid');
        $cid=$this->input->post('cid');
        $lid=$this->input->post('lid');
        $qtype=$this->input->post('quiz_type');
        $date= date("Y-m-d h:i:s");

        foreach($queid as $que){
             $query = $this->db->query("select * from tbl_answer where accountid='$acid' and queid='$que'");
            $rows= $query->num_rows();
            if ($rows == 1) {

}else{
             $options=$this->input->post('test_'.$que);
foreach ($options as $option){
                //echo  $option.' '.$que;

    $data = array(
        'accountid' => $acid,
        'courseid' => $cid,
        'lessonid' => $lid,
        'queid' =>$que,
        'value' => $option,
        'datecreated' => $date

    );



    $this->db->insert('tbl_answer', $data);

            }
        }

        }
      $score=  $this->Dashboard_Model->get_collate_result($acid,$lid);
        $row= $this->Dashboard_Model->get_total_quest($cid,$lid);
        $score= round(( $score / $row ) * 100) ;

        $data = array(
            'accountid' => $acid,
            'courseid' => $cid,
            'lessonid' => $lid,

            'score' => $score,
            'quiz_type' => $qtype,
            'datecreated' => $date

        );

if($qtype == "Final Assessment"){
    $this->db->insert('tbl_result', $data);

    $fname=$this->session->userdata('fname');
    $course=$this->Dashboard_Model->get_course_title($cid);

    $this->slack->send($course.' Final Assessment Completed . Process Score/certificate for User : '.$fname);
       // print_r($this->slack->output); // Print the response from Slack if you want.
$this->actual_score($acid , $cid);

    redirect('dashboard/quiz_complete/' . $cid);
}else {

   $this->db->insert('tbl_result', $data);


        redirect('dashboard/quiz_complete/' . $cid);


}

    }
    public function actual_score_get($id)
    {
         $acid = $this->session->userdata('accountid');

        $data1 = array(

            'accountid' => $acid,
            'courseid' => $id

        );
        $this->db->where($data1);
        $query = $this->db->get('tbl_final_score');
        $data = $query->row_array();
        $score=$data['score'];
        if($score >= 65 ){
            echo '<span class="text-success">'.$score.'%</span> <br> <h2 class="text-success text-center"><i class="fa fa-check-circle"></i> Passed</h2>';
        }else{ echo '<span class="text-warning">'.$score.'%</span> <br> <h2 class="text-warning text-center"><i class="fa fa-thumbs-down"></i> Below Pass Mark!</h2>';}

    }
    public function actual_score($acid , $cid)
    {
       // $acid = $this->session->userdata('accountid');
       // $cid = $this->input->post('cid');
        //$acid = $this->input->post('acid');
        $data1= array(

            'accountid'=>$acid,
            'courseid'=>$cid

        );
        $this->db->where($data1);
        $query = $this->db->get('tbl_final_score');
        $rows = $query->num_rows();
        if($rows == 1){

        }else {
            $date = date("Y-m-d h:i:s");

            $lno = $this->Dashboard_Model->get_total_lesson($cid);
           $fscore = $this->Dashboard_Model->get_final_ass_score($cid);

            $this->db->select_sum('score');
            $data2 = array(
                'accountid' => $acid,
                'courseid' => $cid,
                'quiz_type' => 'Module Quiz'

            );
            $this->db->where($data2);
            $query = $this->db->get("tbl_result");
            $data = $query->row_array();

            $totalmodulescore = $data["score"];
           $lno2=$lno - 1;
           $tmsc = round($totalmodulescore / $lno2);
            $tmsc2=round($tmsc * 0.3);

           $tfs = round($fscore * 0.7);
          $score = round($tmsc2 + $tfs);


            $data1= array(

                'accountid'=>$acid,
                'courseid'=>$cid,
                'score'=>$score,
                 'datecreated'=>$date

            );

            $this->db->insert('tbl_final_score',$data1);

        }
    }
  #END	


#crowdfunding payment with debit card verification 
public function paymentverification (){
	if (isset($_GET['flw_ref'])) {
        $ref = $_GET['flw_ref']; //transaction refno
        $amount = $_GET["amount"];; //Correct Amount from Server
        $currency = "GBP"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-xxxxxxxxxxxxxxxxxxxxxx-X",
            "flw_ref" => $ref,
            "normalize" => "1"
        );
        $data_string = json_encode($query);
                
        $ch = curl_init('http://flw-pms-dev.eu-west-1.elasticbeanstalk.com/flwv3-pug/getpaidx/api/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);
}
//var_dump($resp); testing purpose. raw json output

        $chargeResponse = $resp['data']['flwMeta']['chargeResponse'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['transaction_currency'];

        
        if (($chargeResponse == "00" || $chargeResponse == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          //Give Value and return to Success page
            // return redirect(route('payment_success'));
             return ['success'=>1, 'msg'=> trans('app.payment_received_msg'), 'response' => $this->payment_success_html()];
        } else {
            //Dont Give Value and return to Failure page
             return ['success'=>0, 'msg'=> trans('app.payment_declined_msg'), 'response' => $chargeResponseMessage];
        }
    }


#currency converter function
function convertCurrency($from, $to, $amount){
$url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . $from . '_' . $to . '&compact=ultra');
$json = json_decode($url, true);
$rate = implode(" ",$json);
$total = $rate * $amount;
$rounded = round($total); //optional, rounds to a whole number
return $total; //or return $rounded if you kept the rounding bit from above
}
/* test case
  $from = 'GBP';
  $amount = 100;
  $to = 'USD';
 
 $rawData = convertCurrency($from,$to,$amount);
 var_dump($rawData);
*/



?>