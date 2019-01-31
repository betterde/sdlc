<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Interface scheme logic controller
 *
 * Date: 2019-01-31
 * @author George
 * @package App\Http\Controllers
 */
class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$schemes = Scheme::all();
    	return success($schemes);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'name' => 'string|unique:schemes',
        	'description' => 'nullable',
        	'content' => 'nullable',
		]);

        $scheme = Scheme::create($attributes);
        return stored($scheme);
    }

	/**
	 * Display the specified resource.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Scheme $scheme
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Scheme $scheme)
    {
    	return success($scheme);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param Scheme $scheme
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Scheme $scheme)
    {
		$attributes = $this->validate($request, [
			'name' => [
				'string',
				Rule::unique('schemes')->ignore($scheme->id)
			],
			'description' => 'nullable',
			'content' => 'nullable',
		]);

		$scheme->update($attributes);
		return updated($scheme);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Scheme $scheme
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Scheme $scheme)
    {
        $scheme->delete();
        return deleted();
    }
}
