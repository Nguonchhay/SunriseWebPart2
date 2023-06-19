<?php

class Service {

    public function __construct(
        public $id = 0,
        public $icon,
        public $title,
        public $description
    ) {}

    public static function renderServices() {
        $serviceData = [
            new Service(
                1,
                '<span class="fa-stack fa-4x">
                    <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512z"></path></svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com -->
                    <svg class="svg-inline--fa fa-cart-shopping fa-stack-1x fa-inverse" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-shopping" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg><!-- <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i> Font Awesome fontawesome.com -->
                </span>',
                'E-Commerce',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.'
            ),
            new Service(
                2,
                '<span class="fa-stack fa-4x">
                    <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512z"></path></svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com -->
                    <svg class="svg-inline--fa fa-laptop fa-stack-1x fa-inverse" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="laptop" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M128 32C92.7 32 64 60.7 64 96V352h64V96H512V352h64V96c0-35.3-28.7-64-64-64H128zM19.2 384C8.6 384 0 392.6 0 403.2C0 445.6 34.4 480 76.8 480H563.2c42.4 0 76.8-34.4 76.8-76.8c0-10.6-8.6-19.2-19.2-19.2H19.2z"></path></svg><!-- <i class="fas fa-laptop fa-stack-1x fa-inverse"></i> Font Awesome fontawesome.com -->
                </span>',
                'Responsive Design',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.'
            ),
            new Service(
                3,
                '<span class="fa-stack fa-4x">
                    <svg class="svg-inline--fa fa-circle fa-stack-2x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512z"></path></svg><!-- <i class="fas fa-circle fa-stack-2x text-primary"></i> Font Awesome fontawesome.com -->
                    <svg class="svg-inline--fa fa-lock fa-stack-1x fa-inverse" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="lock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path></svg><!-- <i class="fas fa-lock fa-stack-1x fa-inverse"></i> Font Awesome fontawesome.com -->
                </span>',
                'Web Security',
                'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.'
            )
        ];
        $htmlContent = '<div class="row text-center">';
        foreach ($serviceData as $service) {
            $htmlContent .= '
                <div class="col-md-4">
                    ' . $service->icon . '
                    <h4 class="my-3">' . $service->title . '</h4>
                    <p class="text-muted">' . $service->description . '</p>
                </div>
            ';
        }
        $htmlContent .= '</div>';
        return $htmlContent;
    }
}

?>