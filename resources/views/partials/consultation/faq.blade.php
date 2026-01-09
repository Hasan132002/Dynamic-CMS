<!-- FAQ Section -->
<section class="td_faq_section">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_heading_color td_mb_50">
        <span class="td_accent_color">FREQUENTLY</span> ASKED QUESTIONS
      </h2>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="td_faq_list">
          @foreach($page['faqs'] ?? [] as $index => $faq)
          <div class="td_faq_item wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.05 * $loop->index }}s">
            <div class="td_faq_question d-flex justify-content-between align-items-center" data-faq-index="{{ $loop->index }}">
              <div class="d-flex align-items-center">
                <div class="td_faq_number">
                  <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <span class="td_fs_16 td_semibold td_heading_color">
                  {{ $faq['question'] ?? '' }}
                </span>
              </div>
              <i class="fa-solid fa-chevron-down td_accent_color td_faq_icon"></i>
            </div>
            <div class="td_faq_answer">
              <p class="td_fs_15 td_heading_color td_opacity_7 mb-0 td_leading_spacious">
                {{ $faq['answer'] ?? '' }}
              </p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
