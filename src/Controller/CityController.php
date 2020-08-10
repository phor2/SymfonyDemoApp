<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CityController extends BaseController
{
    private $columns = ['population'];
    /**
     * @Route({
     * "cs": "/mesto",
     * "en": "/city"
     * }, name="city_list")
     * Method({"GET"})
     */
    public function index(Request $request)
    {
        $sort = in_array($request->query->get('sort'), $this->columns) ? $request->query->get('sort') : 'name';
        $order = $request->query->get('order') == 'desc' ? 'DESC' : 'ASC';

        $cityArray = $this->getDoctrine()->getRepository(City::class)->findBy([], [$sort => $order]);
        return $this->render('city/index.html.twig', [
            'controller_name' => 'CityController',
            'city_array' => $cityArray
        ]);
    }

    /**
     * @Route({
     * "cs": "/mesto/pridat",
     * "en": "/city/add"
     * }, name="city_add")
     * Method({"GET, POST"})
     */
    public function add(Request $request)
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'created'
            );
            return $this->redirectToRoute('city_list');
        }
        return $this->render('city/form.html.twig', [
            'form' => $form->createView(),
            'edit' => false
        ]);
    }

    /**
     * @Route({
     * "cs": "/mesto/{id}",
     * "en": "/city/{id}"
     * }, name="city_show")
     * Method({"GET"})
     */
    public function show(int $id)
    {
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);
        return $this->render('city/detail.html.twig', [
            'city' => $city,
        ]);
    }

    /**
     * @Route({
     * "cs": "/mesto/smazat/{id}",
     * "en": "/city/delete/{id}"
     * }, name="city_delete")
     * Method({"GET"})
     */
    public function delete(int $id)
    {
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($city);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'deleted'
        );
        return $this->redirectToRoute('city_list');
    }

    /**
     * @Route({
     * "cs": "/mesto/upravit/{id}",
     * "en": "/city/edit/{id}"
     * }, name="city_edit",
     * requirements={"id"="\d+"})
     * Method({"GET, PUT"})
     */
    public function edit(Request $request, int $id)
    {
        $this->SetTitle('Edit City');
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash(
                'success',
                'updated'
            );
            return $this->redirectToRoute('city_list');
        }
        return $this->render('city/form.html.twig', [
            'form' => $form->createView(),
            'edit' => true
        ]);
    }
}
