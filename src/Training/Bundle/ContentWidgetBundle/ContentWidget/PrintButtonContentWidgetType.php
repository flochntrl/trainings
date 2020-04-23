<?php

namespace Training\Bundle\ContentWidgetBundle\ContentWidget;

use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
use Oro\Bundle\CMSBundle\Entity\ContentWidget;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Twig\Environment;

class PrintButtonContentWidgetType extends AbstractContentWidgetType
{
    /**
     * @inheritDoc
     */
    public static function getName(): string
    {
        return 'print-button';
    }

    public function getLabel(): string
    {
        return 'training.content_widgets.print_button.label';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultTemplate(ContentWidget $contentWidget, Environment $twig): string
    {

        return $twig->render(
            '@TrainingContentWidget/ContentWidget/printButton.html.twig',
            $contentWidget->getSettings()
        );
    }

    public function getSettingsForm(ContentWidget $contentWidget, FormFactoryInterface $formFactory): ?FormInterface
    {
        $formBuilder = $formFactory->createBuilder(FormType::class)
            ->add('text', TextType::class);

        return $formBuilder->getForm();
    }

    protected function getAdditionalInformationBlock(ContentWidget $contentWidget, Environment $twig): string
    {
        return $twig->render(
            '@TrainingContentWidget/ContentWidget/admin/printButtonView.html.twig',
            ['settings' => $contentWidget->getSettings()]
        );
    }
}
