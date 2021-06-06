<?php

namespace Src\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Infrastructure\Repositories\UserRepository;
use Src\Dominio\Entities\User;
use Src\Infrastructure\Services\UserService;
use Src\Infrastructure\Interfaces\UserServiceInterface;
use Interop\Container\ContainerInterface;

trait ApiResponser
{


	private function successResponse($data, $code)
	{
 		   return ["status"=>2,"data"=>$data,"code"=>$code];        

	}

	protected function errorResponse(Response $response,$message, $code)
	{

 		return  $response->withJson([
			 ['error' => $message, 
			 'code' => $code],
			  $code,
			  JSON_PRETTY_PRINT
			  ]);       
	}


	protected function showAll(Response $response,array $data, $code = 200)
	{
		return  $response->withJson($data,$code,JSON_PRETTY_PRINT);
	}

	protected function showOne(Response $response, $data, $code = 200)
	{
		
		return  $response->withJson($this->successResponse($data,$code),$code,JSON_PRETTY_PRINT);

	}

	protected function showMessage($message, $code = 200)
	{
 		return  $response->withJson($this->successResponse($message,$code));
	}

 


	
	protected function filterData(Collection $collection, $transformer)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}

		}
		return $collection;
	}

	protected function sortData(Collection $collection, $transformer)
	{
		if (request()->has('sort_by')) {
			$attribute = $transformer::originalAttribute(request()->sort_by);

			$collection = $collection->sortBy->{$attribute};
		}
		return $collection;
	}

	protected function paginate(Collection $collection)
	{
		$rules = [
			'per_page' => 'integer|min:2|max:50'
		];

		Validator::validate(request()->all(), $rules);

		$page = LengthAwarePaginator::resolveCurrentPage();

		$perPage = 15;
		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
		}

		$results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

		$paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);

		$paginated->appends(request()->all());

		return $paginated;
	}

	protected function transformData($data, $transformer)
	{
		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();
	}

	protected function cacheResponse($data)
	{
		$url = request()->url();
		$queryParams = request()->query();

		ksort($queryParams);

		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($fullUrl, 30/60, function() use($data) {
			return $data;
		});
	}
}