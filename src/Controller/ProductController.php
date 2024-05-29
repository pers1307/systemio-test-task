<?php

namespace App\Controller;

use App\Dto\ProductForCalculatePrice;
use App\Service\PriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly PriceService $priceService
    ) {
    }

    #[Route('/calculate-price', name: 'product_calculate_price', methods: ['POST'])]
    public function calculatePrice(Request $request): JsonResponse
    {
        //        {
        //            "product": 1, // обязательно и цифра
        //            "taxNumber": "DE123456789", // обязательно
        //            "couponCode": "D15" // необязательно
        //        }

        $productForCalculatePrice = new ProductForCalculatePrice(
            $request->get('product'),
            $request->get('taxNumber'),
            $request->get('couponCode'),
        );

        // Вылидируем

        try {
            $price = $this->priceService->calculate($productForCalculatePrice);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'errors' => [$exception->getMessage()],
            ], 400);
        }

        /**
         * Валидация полей
         * Налоговый номер сделать обязательным
         * Купон не обязательным
         */

        /**
         * Сервис для рассчета цены продукта
         */

        /**
         * Сервис для парсинга и получения налога
         */

        /**
         * Сервис для получения и валидации купона
         * Ошибка, если такого купона не существует
         */

        return new JsonResponse([
            'price' => $price,
        ]);
    }
}
