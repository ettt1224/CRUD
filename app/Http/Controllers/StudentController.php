<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Phone;
use App\Models\Hobby;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data  = Student::with('phone')->with('hobbies')->get();


        return view('student.index')->with('data', $data);
    }


    public function create()
    {
        return view('student.create');
    }


    public function store(Request $request)
    {

        $input = $request->except('_token');
        $hobbies = explode(',', $input['hobbies']);

        // studnets
        $data = new Student();
        $data->name = $input['name'];
        $data->mobile = $input['mobile'];
        $data->save();

        // phones
        if (!empty($input['phone'])) {
            $dataPhone = new Phone();
            $dataPhone->name = $input['phone'];
            $dataPhone->student_id = $data->id;
            $dataPhone->save();
        }

        // hobbies
        if (!empty($hobbies)) {
            foreach ($hobbies as $key => $value) {
                $dataHobby = new Hobby();
                $dataHobby->name = $value;
                $dataHobby->student_id = $data->id;
                $dataHobby->save();
            }
        }

        return redirect()->route('students.index');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $data = Student::where('id', $id)->with('phone')->with('hobbies')->first();
        $tmpArr = [];
        foreach ($data->hobbies as $key => $value) {
            $tmpArr[] = $value->name;
        };

        if (!empty($tmpArr)) {
            $data['hobbies_list'] = implode(",", $tmpArr);
        } else {
            $data['hobbies_list'] = '';
        }




        return view('student.edit')->with('data', $data);
    }

    public function update(Request $request, string $id)
    {
        $input = $request->except('_token', '_method');
 
        $data = Student::where('id', $id)->first();
        $data->name = $input['name'];
        $data->mobile = $input['mobile'];
        $data->save();

        // 刪除子表
        Phone::where('student_id', $id)->delete();
        Hobby::where('student_id', $id)->delete();


        if (!empty($input['phone'])) {
            $dataPhone = new Phone();
            $dataPhone->name = $input['phone'];
            $dataPhone->student_id = $data->id;
            $dataPhone->save();
        }

        // hobbies
        $hobbies = explode(',', $input['hobbies']);
        if (!empty($hobbies)) {
            foreach ($hobbies as $key => $value) {
                $dataHobby = new Hobby();
                $dataHobby->name = $value;
                $dataHobby->student_id = $data->id;
                $dataHobby->save();
            }
        }


        return redirect()->route('students.index');
    }
    public function destroy(string $id)
    {

        // 刪除子表
        Phone::where('student_id', $id)->delete();
        Hobby::where('student_id', $id)->delete();

        // 刪除主表
        $data = Student::where('id', $id)->first();
        $data->delete();



        return redirect()->route('students.index');
    }
}
