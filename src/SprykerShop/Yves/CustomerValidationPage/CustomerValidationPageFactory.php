<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\CustomerValidationPage;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\CustomerValidationPage\Dependency\Client\CustomerValidationPageToCustomerClientInterface;
use SprykerShop\Yves\CustomerValidationPage\Dependency\Client\CustomerValidationPageToCustomerStorageClientInterface;
use SprykerShop\Yves\CustomerValidationPage\Dependency\Client\CustomerValidationPageToSessionClientInterface;
use SprykerShop\Yves\CustomerValidationPage\Handler\LogoutInvalidatedCustomerFilterControllerEventHandler;
use SprykerShop\Yves\CustomerValidationPage\Handler\LogoutInvalidatedCustomerFilterControllerEventHandlerInterface;
use SprykerShop\Yves\CustomerValidationPage\Validator\CustomerValidationPageValidator;
use SprykerShop\Yves\CustomerValidationPage\Validator\CustomerValidationPageValidatorInterface;
use Symfony\Cmf\Component\Routing\ChainRouterInterface;

class CustomerValidationPageFactory extends AbstractFactory
{
    public function createLogoutInvalidatedCustomerFilterControllerEventHandler(): LogoutInvalidatedCustomerFilterControllerEventHandlerInterface
    {
        return new LogoutInvalidatedCustomerFilterControllerEventHandler(
            $this->createCustomerValidationPageValidator(),
            $this->getCustomerStorageClient(),
            $this->getCustomerClient(),
            $this->getRouter(),
        );
    }

    public function createCustomerValidationPageValidator(): CustomerValidationPageValidatorInterface
    {
        return new CustomerValidationPageValidator(
            $this->getSessionClient(),
        );
    }

    public function getCustomerStorageClient(): CustomerValidationPageToCustomerStorageClientInterface
    {
        return $this->getProvidedDependency(CustomerValidationPageDependencyProvider::CLIENT_CUSTOMER_STORAGE);
    }

    public function getCustomerClient(): CustomerValidationPageToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerValidationPageDependencyProvider::CLIENT_CUSTOMER);
    }

    public function getSessionClient(): CustomerValidationPageToSessionClientInterface
    {
        return $this->getProvidedDependency(CustomerValidationPageDependencyProvider::CLIENT_SESSION);
    }

    public function getRouter(): ChainRouterInterface
    {
        return $this->getProvidedDependency(CustomerValidationPageDependencyProvider::SERVICE_ROUTER);
    }
}
