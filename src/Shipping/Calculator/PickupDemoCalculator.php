<?php

declare(strict_types=1);

namespace MagentixPickupDemoPlugin\Shipping\Calculator;

use MagentixPickupPlugin\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;

final class PickupDemoCalculator implements CalculatorInterface
{

    /**
     * {@inheritdoc}
     */
    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        return (int) $configuration['amount'];
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'demo_pickup';
    }

    /**
     * Retrieve pickup list
     *
     * @param AddressInterface $address
     * @param OrderInterface $cart
     * @param array $configuration
     * @return array
     */
    public function getPickupList(AddressInterface $address, OrderInterface $cart, array $configuration): array
    {
        // $address->getPostcode();
        // $address->getCountryCode();

        // Load Pickup list here with your own logic

        return [
            'error'  => false,
            'pickup' => $this->getPickup(),
        ];
    }

    /**
     * Retrieve pickup address
     *
     * @param string $pickupId
     * @param array $configuration
     * @return array
     */
    public function getPickupAddress(string $pickupId, array $configuration): array
    {
        // Load Pickup here from pickup id with your own logic

        $pickup = $this->getPickup();

        return [
            'error'  => false,
            'pickup' => $pickup[$pickupId],
        ];
    }

    /**
     * Retrieve Pickup template
     *
     * @return string
     */
    public function getPickupTemplate(): string
    {
        // Leave blank for default template

        return '@MagentixPickupDemoPlugin/checkout/SelectShipping/pickup/list.html.twig';
    }

    /**
     * Retrieve Pickup addresses
     *
     * @return array
     */
    protected function getPickup()
    {
        return [
            'pickup-1' => [
                'id'         => 'pickup-1',
                'company'    => 'Magentix',
                'street_1'   => '38 rue de la blanchisserie',
                'street_2'   => '',
                'city'       => 'SIN LE NOBLE',
                'country'    => 'FR',
                'postcode'   => '59450',
                'latitude'   => '',
                'longitude'  => ''
            ],
            'pickup-2' => [
                'id'         => 'pickup-2',
                'company'    => 'Magentix',
                'street_1'   => '12 rue Lydéric',
                'street_2'   => '',
                'city'       => 'LILLE',
                'country'    => 'FR',
                'postcode'   => '59000',
                'latitude'   => '',
                'longitude'  => ''
            ],
            'pickup-3' => [
                'id'         => 'pickup-3',
                'company'    => 'Magentix',
                'street_1'   => '74 avenue des Champs-Elysées',
                'street_2'   => '',
                'city'       => 'PARIS',
                'country'    => 'FR',
                'postcode'   => '75008',
                'latitude'   => '',
                'longitude'  => ''
            ],
        ];
    }
}
