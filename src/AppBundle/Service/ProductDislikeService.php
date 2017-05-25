<?php
/**
 * Created by PhpStorm.
 * User: vilius
 * Date: 17.5.22
 * Time: 13.24
 */

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;

class ProductDislikeService
{
    protected $session;

    protected $grudai;
    protected $mesa;
    protected $varske;
    protected $zuvis;

    public function __construct(Session $session)
    {
        $this->session = $session;

        $this->grudai = $session->get('grudai');
        $this->mesa = $session->get('mesa');
        $this->varske = $session->get('varske');
        $this->zuvis = $session->get('zuvis');
    }

    public function showSeveralChoices()
    {
        if ($this->mesa == '1' and $this->varske == '1' and $this->zuvis == '1' and $this->grudai == '1') {
            $multiChoice = 'Gaila, jog nevalgote visų produktų. Vertėtų pakeisti mastymą.';
        } elseif ($this->mesa == '1' and $this->varske == '1' and $this->zuvis == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos, varškės bei 
            avižinės košės. Esant prieštaravimui tarp jūsų nemėgstamų produktų 
            alternatyvų, siūlome pasirinkti kiaušinius.';
        } elseif ($this->mesa == '1' and $this->varske == '1' and $this->grudai == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos, varškės bei avižinės košės.
             Esant prieštaravimui tarp jūsų nemėgstamų produktų alternatyvų, siūlome varškę
              su mėsa pakeisti į tuną arba lašišą, o avižas - į makaronus.';
        } elseif ($this->mesa == '1' and $this->zuvis == '1' and $this->grudai == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos, žuvies bei avižinės košės.
             Esant prieštaravimui tarp jūsų nemėgtamų produktų alternatyvų, vietoje mėsos
              ir žuvies siūlome pasirinkti varškę/jogurtą, o viešoje avižų - makaronus.';
        } elseif ($this->zuvis == '1' and $this->grudai == '1' and $this->varske == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate žuvies, avižinės košės bei varškės. 
            Esant prieštaravimui tarp jūsų nemėgstamų produktų, vietoje žuvies ir varškes 
            rinkitės vištieną/jautieną, o vietoje avižinės košes - makaronus.';
        } elseif ($this->mesa == '1' and $this->zuvis == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos ir žuvies. Esant prieštaravimui tarp
             jūsų nemėgstamų produktų, rinkitės pieno produktus - varškę, jogurtą.';
        } elseif ($this->mesa == '1' and $this->varske == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos ir varškės. Esant prieštaravimui tarp
             jūsų nemėgstamų produktų, rinkitės žuvį - tuną arba lašišą.';
        } elseif ($this->mesa == '1' and $this->zuvis == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos ir žuvies. Esant prieštaravimui tarp 
            jūsų nemėgstamų produktų, rinkitės pieno produktus - varške arba jogurtą.';
        } elseif ($this->varske == '1' and $this->grudai == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate varškes ir avižinės košės. Esant prieštaravimui 
            tarp jūsų nemėgstamų produktų alternatyvų, vietoje varškės rinkitės mėsą - jautieną 
            ar vištieną, o vietoje avižinės košės - makaronus/ryžius/grikius.';
        } elseif ($this->mesa == '1' and $this->grudai == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos bei avižinės košės. Esant prieštaravimui
             tarp jūsų nemėgstamų produktų alternatyvų, vietoje mėsos rinkitės varške arba tuną/lašišą, 
            o vietoje avižinės košės - makaronus/ryžius/grikius.';
        } elseif ($this->varske and $this->zuvis) {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate varškės bei žuvies. Esant prieštaravimui
             tarp jūsų nemgėstamų produktų, rinkitės mėsos produktus - jautieną arba vištieną.';
        } elseif ($this->grudai and $this->zuvis) {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate avižinės košės bei žuvies. Esant prieštaravimui 
            tarp jūsų nemėgstamų produktų, vietoje žuvies rinkitės jautieną arba vištieną, o vietoje 
            avižinės košės - makaronus/ryžius/grikius.';
        } else {
            $multiChoice = '';
        }

        return $multiChoice;
    }

    public function isMeatChecked()
    {
        if ($this->mesa == '1') {
            $meatmsg = '1';
        } else {
            $meatmsg = '';
        }

        return $meatmsg;
    }

    public function isCurdChecked()
    {
        if ($this->varske == '1') {
            $curdmsg = '1';
        } else {
            $curdmsg = '';
        }

        return $curdmsg;
    }

    public function isFishChecked()
    {
        if ($this->zuvis == '1') {
            $fishmsg = '1';
        } else {
            $fishmsg = '';
        }

        return $fishmsg;
    }

    public function isGrudaiChecked()
    {
        if ($this->grudai == '1') {
            $grudaimsg = '1';
        } else {
            $grudaimsg = '';
        }

        return $grudaimsg;
    }
}
