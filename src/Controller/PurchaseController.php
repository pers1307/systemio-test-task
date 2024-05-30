<?php

namespace App\Controller;

use App\Dto\ProductForCalculatePrice;
use App\Dto\ProductForPayment;
use App\Service\ErrorFormatService;
use App\Service\Payment\PaymentService;
use App\Service\PriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PurchaseController extends AbstractController
{
    public function __construct(
        private readonly PriceService $priceService,
        private readonly ValidatorInterface $validator,
        private readonly ErrorFormatService $errorFormatService,
        private readonly PaymentService $paymentService,
    ) {
    }

    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(Request $request): JsonResponse
    {
        $inputBag = $request->getPayload();
        $productForPayment = new ProductForPayment(
            $inputBag->get('product'),
            $inputBag->get('taxNumber'),
            $inputBag->get('couponCode'),
            $inputBag->get('paymentProcessor'),
        );

        $errors = $this->validator->validate($productForPayment);
        if (count($errors) > 0) {
            return new JsonResponse([
                'errors' => $this->errorFormatService->format($errors),
            ], 400);
        }

        try {
            $price = $this->priceService->calculate(
                ProductForCalculatePrice::createFromProductForPayment($productForPayment)
            );

            $this->paymentService->payment($productForPayment->getPaymentType(), $price);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'errors' => [$exception->getMessage()],
            ], 400);
        }

        return new JsonResponse(['ok']);
    }
}
