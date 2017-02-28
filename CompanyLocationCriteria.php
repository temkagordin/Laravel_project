<?php

namespace App\Criteria;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;


/**
 * Class CompanyLocationCriteria
 * @package namespace App\Criteria;
 */
class CompanyLocationCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $searchType =  $this->request->searchLocationType;
        $searchValue = $this->request->searchLocation;
        if (!empty($searchType) && !empty($searchValue)){
            switch ($searchType){
                case 'States':
                    $model = $model->join('states as s','id','=','companies.state_id')->where('s.long_name', $searchValue);
                    break;
                case 'ZipCode':
                    $model = $model->where('zip_code',$searchValue);
                    break;
                case 'Locations':
                default:
                    $searchAddressList = explode(',',$searchValue);
                    $city = empty($searchAddressList[0])?null:trim($searchAddressList[0]);
                    $state = empty($searchAddressList[1])?null:trim($searchAddressList[1]);
                    $country = empty($searchAddressList[2])?null:trim($searchAddressList[2]);
                    
                    if ($city){
                        $model = $model->join('cities as c','c.id','=','companies.city_id')->where('c.long_name',$city);
                    }

                    if ($state){
                        $model = $model->join('states as s','s.id','=','companies.state_id')->where('s.long_name', $state);
                    }

                    if ($country){
                        $model = $model->join('countries as cn','cn.id','=','companies.country_id')->where('cn.short_name', $country);
                    }


                    break;
            }
        }
        return $model;
    }
}
