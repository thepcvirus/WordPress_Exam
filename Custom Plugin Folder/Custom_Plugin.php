<?php
/**
 * Template Name: Portfolio Page
 * Description: Displays all projects in a grid layout
 */

get_header(); ?>

<div class="portfolio-container">
    <?php
    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    $projects = new WP_Query($args);
    
    if ($projects->have_posts()) : ?>
        <div class="projects-grid">
            <?php while ($projects->have_posts()) : $projects->the_post(); ?>
                <div class="project-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="project-image">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="project-content">
                        <h3 class="project-title"><?php the_title(); ?></h3>
                        
                        <?php 
                        // Display technology used (assuming it's stored in a custom field)
                        $technologies = get_post_meta(get_the_ID(), 'project_technologies', true);
                        if ($technologies) : ?>
                            <div class="project-technologies">
                                <strong>Technologies:</strong> <?php echo esc_html($technologies); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        // Get project URL (custom field)
                        $project_url = get_post_meta(get_the_ID(), 'project_url', true);
                        if ($project_url) : ?>
                            <a href="<?php echo esc_url($project_url); ?>" class="project-button" target="_blank">
                                View Project
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else : ?>
        <p>No projects found.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>