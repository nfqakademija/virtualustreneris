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
            $multiChoice = 'Kadangi nevalgote visu produktu...';
        } elseif ($this->mesa == '1' and $this->varske == '1' and $this->zuvis == '1') {
            $multiChoice = 'Jūs pasirinkote, jog nemėgstate mėsos, varškės bei grūdų. Esant prieštaravimui
             tarp jūsų nemėgstamų produktų, siūlome pasirinkti kiaušinius.';
        } elseif ($this->mesa == '1' and $this->varske == '1' and $this->grudai == '1') {
            $multiChoice = 'Kadangi nevalgote visko, isskyrus zuvi...';
        } elseif ($this->mesa == '1' and $this->zuvis == '1' and $this->grudai == '1') {
            $multiChoice = 'Nevalgote visko, isskyrus varskes..';
        } elseif ($this->zuvis == '1' and $this->grudai == '1' and $this->varske == '1') {
            $multiChoice = 'Kadangi nevalgote visko, isskyrus mesos...';
        } elseif ($this->mesa == '1' and $this->zuvis == '1') {
            $multiChoice = 'Kadangi nemegstate mesos ir zuvies, ...';
        } elseif ($this->mesa == '1' and $this->varske == '1') {
            $multiChoice = 'Kadangi nevalgote mesos ir varskes, ...';
        } elseif ($this->mesa == '1' and $this->zuvis == '1') {
            $multiChoice = 'Kadangi nevalgote mesos ir zuvies, ...';
        } elseif ($this->varske == '1' and $this->grudai == '1') {
            $multiChoice = 'Kadangi nevalgote varskes ir grudu, ...';
        } elseif ($this->mesa == '1' and $this->grudai == '1') {
            $multiChoice = 'Kadangi nevalgote mesos ir grudines kulturos produktu..';
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
