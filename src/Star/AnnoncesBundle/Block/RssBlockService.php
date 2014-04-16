<?php

// src/Acme/MainBundle/Block/RssBlockService.php
namespace Star\AnnoncesBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BaseBlockService;

class RssBlockService extends BaseBlockService
{
    public function getName()
    {
        return 'Rss Reader';
    }

    /**
     * Define valid options for a block of this type.
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'url'      => false,
            'title'    => 'Feed items',
            'template' => 'AcmeMainBundle:Block:rss.html.twig',
        ));
    }

    /**
     * The block context knows the default settings, but they can be
     * overwritten in the call to render the block.
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        if (!$block->getEnabled()) {
            return new Response();
        }

        // merge settings with those of the concrete block being rendered
        $settings = $blockContext->getSettings();
        $resolver = new OptionsResolver();
        $resolver->setDefaults($settings);
        $settings = $resolver->resolve($block->getOptions());

        $feeds = false;
        if ($settings['url']) {
            $options = array(
                'http' => array(
                    'user_agent' => 'Sonata/RSS Reader',
                    'timeout' => 2,
                )
            );

            // retrieve contents with a specific stream context to avoid php errors
            $content = @file_get_contents($settings['url'], false, stream_context_create($options));

            if ($content) {
                // generate a simple xml element
                try {
                    $feeds = new \SimpleXMLElement($content);
                    $feeds = $feeds->channel->item;
                } catch (\Exception $e) {
                    // silently fail error
                }
            }
        }

        return $this->renderResponse($blockContext->getTemplate(), array(
            'feeds'     => $feeds,
            'block'     => $blockContext->getBlock(),
            'settings'  => $settings
        ), $response);
    }

    // These methods are required by the sonata block service interface.
    // They are not used in the CMF. To edit, create a symfony form or
    // a sonata admin.

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        throw new \Exception();
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        throw new \Exception();
    }
}