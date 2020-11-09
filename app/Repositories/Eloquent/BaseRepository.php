<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Traits\Constants;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    use Constants;
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     */

    /**
     * @param Model $model
    */
    public function __construct(Model $model)
    {
    $this->model = $model;
    }

    /**
     * Get's a Model by it's ID
     *
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Get's a Model by it's ID
     *
     * @param int
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get's a Model by it's ID and returns error on failure
     *
     * @param int
     * @return Model
     */
    public function findorfail($id)
    {
        if(!empty($data = $this->model->find($id))){
            return ['success' => true , 'message' => '' , 'data' => $data , 'code' => $this->successResponse];
        }
        else{
            return ['success' => false , 'message' => 'Sorry couldn`t find this item' , 'data' => null , 'code' => $this->notFoundErrorResponse];
        }
    }

    /**
     * Get's all Models.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * Deletes a Model.
     *
     * @param int
     */
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    /**
     * Create`s new Model
     *
     * @param array attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Updates a Model.
     *
     * @param int
     * @param array attributes
     */
    public function update($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    
}
