<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Product;

final class SitemapProductControllerApiLocalesTest extends AbstractTestController
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setUpDatabase(): void
    {
        parent::setUpDatabase();

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test');
        $product->setCode('test-code');
        $product->setSlug('test');
        $product->setCurrentLocale('nl_NL');
        $product->setName('Test');
        $product->setCode('test-code');
        $product->setSlug('test');
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Mock');
        $product->setCode('mock-code');
        $product->setSlug('mock');
        $product->setCurrentLocale('nl_NL');
        $product->setName('Mock');
        $product->setCode('mock-code');
        $product->setSlug('mock');
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test 2');
        $product->setCode('test-code-3');
        $product->setSlug('test 2');
        $product->setCurrentLocale('nl_NL');
        $product->setName('Test 2');
        $product->setCode('test-code-3');
        $product->setSlug('test 2');
        $product->setEnabled(false);
        $product->addChannel($this->channel);
        $this->getEntityManager()->persist($product);

        $product = new Product();
        $product->setCurrentLocale('en_US');
        $product->setName('Test 3');
        $product->setCode('test-code-4');
        $product->setSlug('test 3');
        $product->setCurrentLocale('nl_NL');
        $product->setName('Test 3');
        $product->setCode('test-code-4');
        $product->setSlug('test 3');
        $product->setEnabled(false);
        $this->getEntityManager()->persist($product);

        $this->getEntityManager()->flush();

        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getBufferedResponse('/sitemap/products.xml');

        $this->assertResponse($response, 'show_sitemap_products_locale');
    }
}
