<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CompanyTypesRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;


class CompanyTypesController extends Controller
{

    private $repository;

    public function __construct(CompanyTypesRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return $this->_set_success($this->repository->with(['companiesCount'])->all());
    }

    public function show($id, Request $request)
    {
        $type = $this->repository->with(['companies'])->find($id);
        if ($type) {
            return $this->_set_success($type);
        } else {
            return $this->_set_error(['company_id' => 'Company \"' . $id . '\" not found']);
        }
    }

    public function validate_company_type(Array $data)
    {
        $validation = Validator::make($data, [
            'type' => 'required|max:255',
            'description' => 'required|max:255',
            'active' => 'required'
        ]);
        return $validation;

    }

    public function store(Request $request)
    {
        $data = $request->only('type', 'description', 'active');
        $validation = $this->validate_company_type($data);


        if ($validation->fails()) {
            $errors = $validation->errors()->first();
            return $this->_set_error($errors);
        }
        $type_company = $this->repository->create($data);

        return $type_company;
    }

    public function update($id, Request $request)
    {
        $company_type = $this->repository->find($id);
        if ($company_type) {
            $data = $request->only('type', 'description', 'active');
            $validator = $this->validate_company_type($data);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return $this->_set_error($errors);
            }
            $companys = $this->repository->update($data, $id);
            return $companys;
        }

    }

    public function destroy(Request $request, $id)
    {
        $company_type = $this->repository->find($id);
        if ($company_type) {
            if ($company_type->destroy($id)) {

            } else {return $this->_set_error('can not delete');
            }
        } else {return $this->_set_error('not found');
        }
    }

}
