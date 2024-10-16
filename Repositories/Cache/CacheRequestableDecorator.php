<?php

namespace Modules\Requestable\Repositories\Cache;

use Modules\Requestable\Repositories\RequestableRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRequestableDecorator extends BaseCacheDecorator implements RequestableRepository
{
  public function __construct(RequestableRepository $requestable)
  {
    parent::__construct();
    $this->entityName = 'requestable.requestables';
    $this->repository = $requestable;
  }
  
  /**
   * List or resources
   *
   * @return collection
   */
  public function getItemsBy($params)
  {
    return $this->remember(function () use ($params) {
      return $this->repository->getItemsBy($params);
    });
  }
  
  /**
   * find a resource by id or slug
   *
   * @return object
   */
  public function getItem($criteria, $params = false)
  {
    return $this->remember(function () use ($criteria, $params) {
      return $this->repository->getItem($criteria, $params);
    });
  }
  
  /**
   * create a resource
   *
   * @return mixed
   */
  public function create($data)
  {
    $this->clearCache();
    return $this->repository->create($data);
  }
  
  /**
   * update a resource
   *
   * @return mixed
   */
  public function updateBy($criteria, $data, $params = false)
  {
    $this->clearCache();
    
    return $this->repository->updateBy($criteria, $data, $params);
  }
  
  
  /**
   * destroy a resource
   *
   * @return mixed
   */
  public function deleteBy($criteria, $params = false)
  {
    $this->clearCache();
    
    return $this->repository->deleteBy($criteria, $params);
  }

  public function moduleConfigs()
  {
    return $this->repository->moduleConfigs();
  }

  public function leadsByStatus($params = false)
  {
    return $this->repository->leadsByStatus($params);
  }
}
