<?php

namespace TodasAsPatas\ApiBundle\Controller;

use ByteinCoffee\ExtraBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use TodasAsPatas\ApiBundle\Entity\Pet;
use TodasAsPatas\ApiBundle\Entity\PetAdoption;
use TodasAsPatas\ApiBundle\Entity\PetRepository;
use TodasAsPatas\ApiBundle\Entity\UserCommon;
use TodasAsPatas\ApiBundle\Entity\UserCommonRepository;

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
        /* @var $userCommonRepository UserCommonRepository */
        /* @var $userCommon UserCommon */
        $petRepository = $this->get('app.repository.pet');
        $userCommonRepository = $this->get('app.repository.usercommon');
        $request = $this->get('request_stack')->getCurrentRequest();
        $pet = $petRepository->find($request->get('petId'));
        if ($pet === null) {
            throw $this->createNotFoundException('Pet não encontrado!');
        }

        $petAdoption = $this->resourceResolver->createResource($this->getRepository(), 'createNew');
        $petAdoption->setPet($pet);

        if ($request->get('userId')) {
            
            $userCommon = $userCommonRepository->find($request->get('userId'));
            if ($userCommon === null) {
                throw $this->createNotFoundException('Usuário não encontrado');
            }

            $petAdoption->setUser($userCommon);
        }

        return $petAdoption;
    }

}
