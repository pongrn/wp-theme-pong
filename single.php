<?php get_header(); ?>
    <section class="conteudo-post">
        <div class="row">
            <div class="pong-breadcrumbs small-12 medium-12 large-12 column text-right">
                Início / Categoria / <a href="#">Lorem ipsum</a>
            </div>
        </div>

        <div class="row">
            <article class="posts-wrapper bg-claro small-11 small-centered medium-8 medium-uncentered large-8 large-uncentered column">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="post-titulo text-center">
                            <?php the_title('<h1>', '</h1>'); ?>
                            <?php the_time('j \d\e F \d\e Y'); ?> - <?php the_author_posts_link(); ?> - <?php comments_popup_link('Nenhum comentário', '1 comentário', '% comentários', 'comments-link', ''); ?><br>
                            Tempo estimado de leitura: XX minutos
                        </div>

                        <div class="post-texto">
                            <?php the_content(); ?>
                        </div>

                        <div class="post-comentarios">
                            <?php comments_template(); ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="post-404 post-titulo text-center">
                        <h1>404 - Not Found</h1>
                        <p>Post não encontrado.</p>
                    </div>
                <?php endif; ?>
            </article>
            <?php get_sidebar(); ?>
        </div>
    </section>
<?php get_footer(); ?>