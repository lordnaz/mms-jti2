<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\JtiPlan as JtiPlan;

// from external DB 
use App\Models\JtiSales as JtiSales;
use App\Models\CompanyClientSales as CompanyClient;
use App\Models\QuotationSales as Quotation;
use App\Models\UserSales as UserSales;
use App\Models\StateSales as States;
use App\Models\CountrySales as Countries;
use App\Models\JtiCreatedSales as JtiCreated;

class JtiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $task_counter = JtiPlan::where('assign_to', $user_id)
                                ->where('new_flag', true)
                                ->count();

        Session::put('task_counter', $task_counter);
        
    }

    public function goToJtiActual($jti_no){

        // return view('components.jti-actual', compact('jti_no'));

        $JtiRecordDetails = JtiPlan::where('running_no', $jti_no)
                                ->get()
                                ->first();

        $mode = $JtiRecordDetails->mode;
        
        return view('components.jti-actual', compact('jti_no', 'JtiRecordDetails', 'mode'));

    }

    public function getAllUser($quote_no){

        $users = User::all();

        $quotation = Quotation::where('identifier', $quote_no)
                                    ->get()
                                    ->first();

        $company = CompanyClient::where('id', $quotation['created_for_company'])
                                    ->get()
                                    ->first();
        
        $state = States::where('id', $company['state_id'])
                                    ->get('name')
                                    ->first();

        $country = Countries::where('id', $company['country_id'])
                                    ->get('name')
                                    ->first();

        $issued_by = UserSales::where('id', $quotation['created_by'])
                                    ->get('fullname')
                                    ->first();  
                                    
        $officer = UserSales::where('id', $quotation['created_for_pic'])
                                    ->get()
                                    ->first();
                            

        // return $jti_sales_data; 
        
        // $current_dt = date('d/m/Y h:i:s a', time());

        return view('components.jti-form', compact('users', 'quotation', 'company', 'issued_by', 'officer', 'state', 'country'));
    }

    public function submitForm(Request $req){

        $data = $req->input();
    

        $currentdt = date('d-m-Y H:i:s');
        
        // Job Descript List Section 
        $jobDescArr = array();
        $jobDescList = "";

        $packing = $req->packing;
        if($packing != null || $packing != ""){
            array_push($jobDescArr, $packing);
        }

        $unpacking = $req->unpacking;
        if($unpacking != null || $unpacking != ""){
            array_push($jobDescArr, $unpacking);
        }

        $removals = $req->removals;
        if($removals != null || $removals != ""){
            array_push($jobDescArr, $removals);
        }

        $trucking = $req->trucking;
        if($trucking != null || $trucking != ""){
            array_push($jobDescArr, $trucking);
        }

        $shipment = $req->shipment;
        if($shipment != null || $shipment != ""){
            array_push($jobDescArr, $shipment);
        }

        $import = $req->import;
        if($import != null || $import != ""){
            array_push($jobDescArr, $import);
        }

        $console = $req->console;
        if($console != null || $console != ""){
            array_push($jobDescArr, $console);
        }

        $intermove = $req->intermove;
        if($intermove != null || $intermove != ""){
            array_push($jobDescArr, $intermove);
        }

        $local = $req->local;
        if($local != null || $local != ""){
            array_push($jobDescArr, $local);
        }

        $international = $req->international;
        if($international != null || $international != ""){
            array_push($jobDescArr, $international);
        }

        $household = $req->household;
        if($household != null || $household != ""){
            array_push($jobDescArr, $household);
        }

        $vehicle = $req->vehicle;
        if($vehicle != null || $vehicle != ""){
            array_push($jobDescArr, $vehicle);
        }

        $office_good = $req->office_good;
        if($office_good != null || $office_good != ""){
            array_push($jobDescArr, $office_good);
        }

        foreach($jobDescArr as $task){
            $jobDescList .= $task;
          
            if (end($jobDescArr) == $task) {
                # code...
            }
            else{
                $jobDescList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }


        // Material List Section 
        $MaterialArr = array();
        $MaterialList = "";

        $m1 = $req->m1;
        if($m1 != null || $m1 > 0 ){
            array_push($MaterialArr, $m1." x Boxes - S [19 x 14 x 14']");
        }

        $m2 = $req->m2;
        if($m2 != null || $m2 > 0){
            array_push($MaterialArr, $m2." x Boxes - M [17 x 17 x 17']");
        }

        $m3 = $req->m3;
        if($m3 != null || $m3 > 0){
            array_push($MaterialArr, $m3." x Boxes - M [18 x 18 x 18']");
        }

        $m4 = $req->m4;
        if($m4 != null || $m4 > 0){
            array_push($MaterialArr, $m4." x Boxes - L [ 19 x 19 x 30']");
        }

        $m5 = $req->m5;
        if($m5 != null || $m5 > 0){
            array_push($MaterialArr, $m5." x Boxes - [21 x 20 x 20']");
        }

        $m6 = $req->m6;
        if($m6 != null || $m6 > 0){
            array_push($MaterialArr, $m6." x Empty Boxes (USED)");
        }

        $m7 = $req->m7;
        if($m7 != null || $m7 > 0){
            array_push($MaterialArr, $m7." x Corrugated Paper Roll");
        }

        $m8 = $req->m8;
        if($m8 != null || $m8 > 0){
            array_push($MaterialArr, $m8." x Wardrobe / Hanging Ctn");
        }

        $m9 = $req->m9;
        if($m9 != null || $m9 > 0){
            array_push($MaterialArr, $m9." x Air-Bubblepack");
        }

        $m10 = $req->m10;
        if($m10 != null || $m10 > 0){
            array_push($MaterialArr, $m10." x PE Foam");
        }

        $m11 = $req->m11;
        if($m11 != null || $m11 > 0){
            array_push($MaterialArr, $m11." x White Tape (Eco)");
        }

        $m12 = $req->m12;
        if($m12 != null || $m12 > 0){
            array_push($MaterialArr, $m12." x OPP Tape -'KLCCUH'");
        }

        $m13 = $req->m13;
        if($m13 != null || $m13 > 0){
            array_push($MaterialArr, $m13." x OPP Tape (Brown)");
        }

        $m14 = $req->m14;
        if($m14 != null || $m14 > 0){
            array_push($MaterialArr, $m14." x Masking Tape");
        }

        $m15 = $req->m15;
        if($m15 != null || $m15 > 0){
            array_push($MaterialArr, $m15." x Fragile Tape");
        }

        $m16 = $req->m16;
        if($m16 != null || $m16 > 0){
            array_push($MaterialArr, $m16." x Stretch Film");
        }

        $m17 = $req->m17;
        if($m17 != null || $m17 > 0){
            array_push($MaterialArr, $m17." x Newsprint Paper");
        }

        $m18 = $req->m18;
        if($m18 != null || $m18 > 0){
            array_push($MaterialArr, $m18." x Steel Strapping Rope");
        }

        $m19 = $req->m19;
        if($m19 != null || $m19 > 0){
            array_push($MaterialArr, $m19." x Sticker Color");
        }

        foreach($MaterialArr as $material){
            $MaterialList .= $material;
          
            if (end($MaterialArr) == $material) {
                # code...
            }
            else{
                $MaterialList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }


        // Job Descript List Section 
        $EquipmentArr = array();
        $EquipmentList = "";

        $e1 = $req->e1;
        if($e1 != null || $e1 != ""){
            array_push($EquipmentArr, $e1);
        }

        $e2 = $req->e2;
        if($e2 != null || $e2 != ""){
            array_push($EquipmentArr, $e2);
        }

        $e3 = $req->e3;
        if($e3 != null || $e3 != ""){
            array_push($EquipmentArr, $e3);
        }

        $e4 = $req->e4;
        if($e4 != null || $e4 != ""){
            array_push($EquipmentArr, $e4);
        }

        $e5 = $req->e5;
        if($e5 != null || $e5 != ""){
            array_push($EquipmentArr, $e5);
        }

        $e6 = $req->e6;
        if($e6 != null || $e6 != ""){
            array_push($EquipmentArr, $e6);
        }

        $e7 = $req->e7;
        if($e7 != null || $e7 != ""){
            array_push($EquipmentArr, $e7);
        }

        $e8 = $req->e8;
        if($e8 != null || $e8 != ""){
            array_push($EquipmentArr, $e8);
        }

        $e9 = $req->e9;
        if($e9 != null || $e9 != ""){
            array_push($EquipmentArr, $e9);
        }

        $e10 = $req->e10;
        if($e10 != null || $e10 != ""){
            array_push($EquipmentArr, $e10);
        }

        $e11 = $req->e11;
        if($e11 != null || $e11 != ""){
            array_push($EquipmentArr, $e11);
        }

        $e12 = $req->e12;
        if($e12 != null || $e12 != ""){
            array_push($EquipmentArr, $e12);
        }

        $e13 = $req->e13;
        if($e13 != null || $e13 != ""){
            array_push($EquipmentArr, $e13);
        }

        $e14 = $req->e14;
        if($e14 != null || $e14 != ""){
            array_push($EquipmentArr, $e14);
        }


        foreach($EquipmentArr as $equipment){
            $EquipmentList .= $equipment;
          
            if (end($EquipmentArr) == $equipment) {
                # code...
            }
            else{
                $EquipmentList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }

        // return $EquipmentList;

        //file attachment section
        $file = $req->file('file-upload');
        $po_encoded = base64_encode(file_get_contents($req->file('file-upload')));
        $mime_type = $file->getClientmimeType();

        $po_string = "data:".$mime_type.";base64,".$po_encoded;

        $count = JtiPlan::count();

        $count++;

        $gen_jti = "JTI_".$count;

        $jtiplan = new JtiPlan;

        $jtiplan->quotation_no = $req->quote_no;
        $jtiplan->running_no = $gen_jti;
        $jtiplan->po_no = $req->po_no;
        $jtiplan->po_attachment = $po_string;
        $jtiplan->issued_by = $req->sales_guy;
        $jtiplan->assign_to = $req->assignto;
        $jtiplan->company_name = $req->company_name;
        $jtiplan->pic_name = $req->pic_name;
        $jtiplan->company_address = $req->address;
        $jtiplan->contact = $req->contact;
        $jtiplan->volume = $req->est_volume;
        $jtiplan->mode = $req->mode;
        $jtiplan->start_date = $req->start_date;
        $jtiplan->end_date = $req->end_date;
        $jtiplan->period = $req->period;
        $jtiplan->job_list = $jobDescList;
        $jtiplan->from_destination = $req->from;
        $jtiplan->to_destination = $req->to;
        $jtiplan->job_details = $req->job_instruction;
        $jtiplan->manpower = $req->manpower;
        $jtiplan->trucks = $req->trucks;
        $jtiplan->material_list = $MaterialList;
        $jtiplan->equipment_list = $EquipmentList;
        $jtiplan->special_instruction = $req->special_instruct;
        $jtiplan->created_at = $currentdt;
        $jtiplan->updated_at = $currentdt;

        $jtiplan->save();

        // check jti if created
        $exists = JtiPlan::where('quotation_no', $req->quote_no)->exists();

        if($exists){
            $jti_created = new JtiCreated;

            $jti_created->quote_no = $req->quote_no;
            $jti_created->jti_no = $gen_jti;
            $jti_created->po_no = $req->po_no;
            $jti_created->created_at = $currentdt;

            $jti_created->save();
        }
        // JtiCreated

        return redirect()->route('jti_form', ['quote_no' => $req->quote_no]);
    }

    public function confirmForm(Request $req, $jti_no){

        $data = $req->input();

        // Job Descript List Section 
        $jobDescArr = array();
        $jobDescList = "";

        $packing = $req->packing;
        if($packing != null || $packing != ""){
            array_push($jobDescArr, $packing);
        }

        $unpacking = $req->unpacking;
        if($unpacking != null || $unpacking != ""){
            array_push($jobDescArr, $unpacking);
        }

        $removals = $req->removals;
        if($removals != null || $removals != ""){
            array_push($jobDescArr, $removals);
        }

        $trucking = $req->trucking;
        if($trucking != null || $trucking != ""){
            array_push($jobDescArr, $trucking);
        }

        $shipment = $req->shipment;
        if($shipment != null || $shipment != ""){
            array_push($jobDescArr, $shipment);
        }

        $import = $req->import;
        if($import != null || $import != ""){
            array_push($jobDescArr, $import);
        }

        $console = $req->console;
        if($console != null || $console != ""){
            array_push($jobDescArr, $console);
        }

        $intermove = $req->intermove;
        if($intermove != null || $intermove != ""){
            array_push($jobDescArr, $intermove);
        }

        $local = $req->local;
        if($local != null || $local != ""){
            array_push($jobDescArr, $local);
        }

        $international = $req->international;
        if($international != null || $international != ""){
            array_push($jobDescArr, $international);
        }

        $household = $req->household;
        if($household != null || $household != ""){
            array_push($jobDescArr, $household);
        }

        $vehicle = $req->vehicle;
        if($vehicle != null || $vehicle != ""){
            array_push($jobDescArr, $vehicle);
        }

        $office_good = $req->office_good;
        if($office_good != null || $office_good != ""){
            array_push($jobDescArr, $office_good);
        }

        foreach($jobDescArr as $task){
            $jobDescList .= $task;
          
            if (end($jobDescArr) == $task) {
                # code...
            }
            else{
                $jobDescList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }


        // Material List Section 
        $MaterialArr = array();
        $MaterialList = "";

        $m1 = $req->m1;
        if($m1 != 0 ){
            array_push($MaterialArr, $m1." x Boxes - S [19 x 14 x 14']");
        }

        $m2 = $req->m2;
        if($m2 != 0){
            array_push($MaterialArr, $m2." x Boxes - M [17 x 17 x 17']");
        }

        $m3 = $req->m3;
        if($m3 != 0){
            array_push($MaterialArr, $m3." x Boxes - M [18 x 18 x 18']");
        }

        $m4 = $req->m4;
        if($m4 != 0){
            array_push($MaterialArr, $m4." x Boxes - L [ 19 x 19 x 30']");
        }

        $m5 = $req->m5;
        if($m5 != 0){
            array_push($MaterialArr, $m5." x Boxes - [21 x 20 x 20']");
        }

        $m6 = $req->m6;
        if($m6 != 0){
            array_push($MaterialArr, $m6." x Empty Boxes (USED)");
        }

        $m7 = $req->m7;
        if($m7 != 0){
            array_push($MaterialArr, $m7." x Corrugated Paper Roll");
        }

        $m8 = $req->m8;
        if($m8 != 0){
            array_push($MaterialArr, $m8." x Wardrobe / Hanging Ctn");
        }

        $m9 = $req->m9;
        if($m9 != 0){
            array_push($MaterialArr, $m9." x Air-Bubblepack");
        }

        $m10 = $req->m10;
        if($m10 != 0){
            array_push($MaterialArr, $m10." x PE Foam");
        }

        $m11 = $req->m11;
        if($m11 != 0){
            array_push($MaterialArr, $m11." x White Tape (Eco)");
        }

        $m12 = $req->m12;
        if($m12 != 0){
            array_push($MaterialArr, $m12." x OPP Tape -'KLCCUH'");
        }

        $m13 = $req->m13;
        if($m13 != 0){
            array_push($MaterialArr, $m13." x OPP Tape (Brown)");
        }

        $m14 = $req->m14;
        if($m14 != 0){
            array_push($MaterialArr, $m14." x Masking Tape");
        }

        $m15 = $req->m15;
        if($m15 != 0){
            array_push($MaterialArr, $m15." x Fragile Tape");
        }

        $m16 = $req->m16;
        if($m16 != 0){
            array_push($MaterialArr, $m16." x Stretch Film");
        }

        $m17 = $req->m17;
        if($m17 != 0){
            array_push($MaterialArr, $m17." x Newsprint Paper");
        }

        $m18 = $req->m18;
        if($m18 != 0 || $m18 != null){
            array_push($MaterialArr, $m18." x Steel Strapping Rope");
        }

        $m19 = $req->m19;
        if($m19 != 0){
            array_push($MaterialArr, $m19." x Sticker Color");
        }

        foreach($MaterialArr as $material){
            $MaterialList .= $material;
          
            if (end($MaterialArr) == $material) {
                # code...
            }
            else{
                $MaterialList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }


        // Job Descript List Section 
        $EquipmentArr = array();
        $EquipmentList = "";

        $e1 = $req->e1;
        if($e1 != null || $e1 != ""){
            array_push($EquipmentArr, $e1);
        }

        $e2 = $req->e2;
        if($e2 != null || $e2 != ""){
            array_push($EquipmentArr, $e2);
        }

        $e3 = $req->e3;
        if($e3 != null || $e3 != ""){
            array_push($EquipmentArr, $e3);
        }

        $e4 = $req->e4;
        if($e4 != null || $e4 != ""){
            array_push($EquipmentArr, $e4);
        }

        $e5 = $req->e5;
        if($e5 != null || $e5 != ""){
            array_push($EquipmentArr, $e5);
        }

        $e6 = $req->e6;
        if($e6 != null || $e6 != ""){
            array_push($EquipmentArr, $e6);
        }

        $e7 = $req->e7;
        if($e7 != null || $e7 != ""){
            array_push($EquipmentArr, $e7);
        }

        $e8 = $req->e8;
        if($e8 != null || $e8 != ""){
            array_push($EquipmentArr, $e8);
        }

        $e9 = $req->e9;
        if($e9 != null || $e9 != ""){
            array_push($EquipmentArr, $e9);
        }

        $e10 = $req->e10;
        if($e10 != null || $e10 != ""){
            array_push($EquipmentArr, $e10);
        }

        $e11 = $req->e11;
        if($e11 != null || $e11 != ""){
            array_push($EquipmentArr, $e11);
        }

        $e12 = $req->e12;
        if($e12 != null || $e12 != ""){
            array_push($EquipmentArr, $e12);
        }

        $e13 = $req->e13;
        if($e13 != null || $e13 != ""){
            array_push($EquipmentArr, $e13);
        }

        $e14 = $req->e14;
        if($e14 != null || $e14 != ""){
            array_push($EquipmentArr, $e14);
        }


        foreach($EquipmentArr as $equipment){
            $EquipmentList .= $equipment;
          
            if (end($EquipmentArr) == $equipment) {
                # code...
            }
            else{
                $EquipmentList .= ", ";
            }
        
            // $jti_subtask=$process->createJTIsubTask($jobid,$task);
        }


        // return $EquipmentList;

        // exit();

        $currentdt = date('Y-m-d H:i:s');

        $updateJtiPlan = JtiPlan::where('running_no', $req->jti_no)
                        ->update([
                            'volume' => $req->est_volume, 
                            'mode' => $req->mode,
                            'period' => $req->period,
                            'manpower' => $req->manpower,
                            'trucks' => $req->trucks,
                            'manpower' => $req->manpower,
                            'job_list' => $jobDescList,
                            'material_list' => $MaterialList,
                            'equipment_list' => $EquipmentList,
                            // 'updated_by' => auth()->user()->id,
                            'new_flag' => false,
                            'updated_at' => $currentdt
                        ]);

        return redirect()->route('mytask');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
