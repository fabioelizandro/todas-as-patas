<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetAdoption;
use TodasAsPatas\ApiBundle\Entity\PetRepository;

class PetAdoptionController extends BaseController
{

    /**
     * @return object
     */
    public function createNew()
    {
        /* @var $petRepository PetRepository */
        /* @var $request Request */
        /* @var $pet Pet */
        /* @var $petAdoption PetAdoption */
        $petRepository = $this->get('app.repository.pet');
        $request = $this->get('request_stack')->getCurrentRequest();
        $pet = $petRepository->find($request->get('petId'));

        $petAdoption = $this->resourceResolver->createResource($this->getRepository(), 'createNew');
        $petAdoption->setPet($pet);

        return $petAdoption;
    }

}
