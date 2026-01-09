<?php

namespace Database\Seeders;

use App\Models\GlobalMenuItem;
use App\Models\GlobalPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GlobalMenuPhase1Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // 1) Seed pages from your routes list (static ones)
            $routesPages = [
                ['title' => 'Home', 'route_uri' => '/home', 'controller' => 'HomeController', 'method' => 'homeV1'],
                ['title' => 'Home V1', 'route_uri' => '/home-v1', 'controller' => 'HomeController', 'method' => 'homeV1'],
                ['title' => 'Home V2', 'route_uri' => '/home-v2', 'controller' => 'HomeController', 'method' => 'homeV2'],
                ['title' => 'Home V3', 'route_uri' => '/home-v3', 'controller' => 'HomeController', 'method' => 'homeV3'],
                ['title' => 'Home V4', 'route_uri' => '/home-v4', 'controller' => 'HomeController', 'method' => 'homeV4'],
                ['title' => 'Home V5', 'route_uri' => '/home-v5', 'controller' => 'HomeController', 'method' => 'homeV5'],
                ['title' => 'Home V6', 'route_uri' => '/home-v6', 'controller' => 'HomeController', 'method' => 'homeV6'],
                ['title' => 'Home V7', 'route_uri' => '/home-v7', 'controller' => 'HomeController', 'method' => 'homeV7'],
                ['title' => 'Home V8', 'route_uri' => '/home-v8', 'controller' => 'HomeController', 'method' => 'homeV8'],

                ['title' => 'About', 'route_uri' => '/about', 'controller' => 'AboutController', 'method' => 'index'],
                ['title' => 'Contact', 'route_uri' => '/contact', 'controller' => 'ContactController', 'method' => 'index'],

                ['title' => 'Courses Grid View', 'route_uri' => '/courses-grid-view', 'controller' => 'CoursesController', 'method' => 'grid'],
                ['title' => 'Courses Grid With Sidebar', 'route_uri' => '/courses-grid-with-sidebar', 'controller' => 'CoursesController', 'method' => 'gridWithSidebar'],
                ['title' => 'Courses List View', 'route_uri' => '/courses-list-view', 'controller' => 'CoursesController', 'method' => 'list'],
                ['title' => 'Course Details', 'route_uri' => '/course-details', 'controller' => 'CoursesController', 'method' => 'details'],

                ['title' => 'Blogs', 'route_uri' => '/blog', 'controller' => 'BlogsController', 'method' => 'blogs'],
                ['title' => 'Blog With Sidebar', 'route_uri' => '/blog-with-sidebar', 'controller' => 'BlogsController', 'method' => 'blogWithSidebar'],
                ['title' => 'Blog Details', 'route_uri' => '/blog-details', 'controller' => 'BlogsController', 'method' => 'details'],

                ['title' => 'Upcoming Events', 'route_uri' => '/event', 'controller' => 'UpcomingeEventController', 'method' => 'index'],
                ['title' => 'Event Details', 'route_uri' => '/event-details', 'controller' => 'EventdetailsController', 'method' => 'index'],

                ['title' => 'Team Members', 'route_uri' => '/team-members', 'controller' => 'TeamMemberController', 'method' => 'index'],
                ['title' => 'Team Member Details', 'route_uri' => '/team-member-details', 'controller' => 'TeamDetailsController', 'method' => 'index'],

                ['title' => 'Students Registration', 'route_uri' => '/students-registrations', 'controller' => 'StudentsRegistrationController', 'method' => 'index'],
                ['title' => 'Instructor Registration', 'route_uri' => '/instructor-registrations', 'controller' => 'InstructorRegistrationController', 'method' => 'index'],

                ['title' => 'Signup', 'route_uri' => '/signup', 'controller' => 'SignUpController', 'method' => 'index'],
                ['title' => 'Signin', 'route_uri' => '/signin', 'controller' => 'SignInController', 'method' => 'index'],

                ['title' => 'FAQs', 'route_uri' => '/faqs', 'controller' => 'faqController', 'method' => 'index'],

                ['title' => 'Cart', 'route_uri' => '/cart', 'controller' => 'CartController', 'method' => 'index'],
                ['title' => 'Checkout', 'route_uri' => '/checkout', 'controller' => 'CheckoutController', 'method' => 'index'],
                ['title' => 'Error', 'route_uri' => '/error', 'controller' => 'ErrorController', 'method' => 'index'],

                ['title' => 'Department', 'route_uri' => '/department', 'controller' => 'DepartmentController', 'method' => 'index'],

                // Admissions pages
                ['title' => 'Admissions', 'route_uri' => '/admissions', 'controller' => 'AdmissionsController', 'method' => 'index'],
                ['title' => 'Consultation', 'route_uri' => '/consultation', 'controller' => 'ConsultationController', 'method' => 'index'],
                ['title' => 'Credit Transfer', 'route_uri' => '/credit-transfer', 'controller' => 'CreditTransferController', 'method' => 'index'],
                ['title' => 'Scholarships', 'route_uri' => '/scholarships', 'controller' => 'ScholarshipsController', 'method' => 'index'],
                ['title' => 'Financial Aid', 'route_uri' => '/financial-aid', 'controller' => 'FinancialAidController', 'method' => 'index'],
            ];

            foreach ($routesPages as $i => $p) {
                GlobalPage::updateOrCreate(
                    ['route_uri' => $this->normalizeUri($p['route_uri'])],
                    [
                        'title' => $p['title'],
                        'slug' => $this->slugFromUri($p['route_uri']),
                        'controller' => $p['controller'],
                        'method' => $p['method'],
                        'is_dynamic' => false,
                        'is_missing_route' => false,
                        // default: off until menu import turns it on
                        'in_menu' => false,
                        'is_active' => false,
                        'menu_order' => $i + 1,
                    ]
                );
            }

            // 2) Import menu structure from JSON file
            // Update this path if your file name differs:
            $jsonPath = storage_path('app/content/global-json/global-navigation.json');

            if (!file_exists($jsonPath)) {
                // If file doesn't exist, we still keep pages table. Menu items import will be skipped.
                return;
            }

            $json = json_decode(file_get_contents($jsonPath), true);
            if (!is_array($json)) return;

            // Clear old menu items for clean re-seed
            GlobalMenuItem::query()->delete();

            // import locations
            $this->importMenuLocation($json, 'header.category.items', data_get($json, 'header.category.items', []));
            $this->importMenuLocation($json, 'header.menu', data_get($json, 'header.menu', []));
            $this->importMenuLocation($json, 'header.menu_left', data_get($json, 'header.menu_left', []));
            $this->importMenuLocation($json, 'header.menu_right', data_get($json, 'header.menu_right', []));

            // footer example (if exists)
            $this->importMenuLocation($json, 'footer.navigate.links', data_get($json, 'footer.navigate.links', []));
        });
    }

    private function importMenuLocation(array $json, string $location, array $items): void
    {
        $order = 0;

        foreach ($items as $item) {
            $order++;

            // Mega menu "Pages" style (columns)
            if (!empty($item['mega']) && !empty($item['columns']) && is_array($item['columns'])) {
                $parent = GlobalMenuItem::create([
                    'location' => $location,
                    'parent_id' => null,
                    'label' => $item['label'] ?? 'Pages',
                    'url' => $item['url'] ?? '#',
                    'is_mega' => true,
                    'group_title' => null,
                    'page_id' => $this->resolvePageId($item['url'] ?? null),
                    'item_order' => $order,
                    'is_active' => true,
                ]);

                $colOrder = 0;
                foreach ($item['columns'] as $col) {
                    $colOrder++;
                    $groupTitle = $col['title'] ?? null;
                    $links = $col['links'] ?? [];
                    $linkOrder = 0;

                    foreach ($links as $link) {
                        $linkOrder++;
                        GlobalMenuItem::create([
                            'location' => $location,
                            'parent_id' => $parent->id,
                            'label' => $link['label'] ?? 'Link',
                            'url' => $link['url'] ?? '#',
                            'is_mega' => false,
                            'group_title' => $groupTitle,
                            'page_id' => $this->resolvePageId($link['url'] ?? null),
                            'item_order' => ($colOrder * 100) + $linkOrder,
                            'is_active' => true,
                        ]);
                    }
                }

                continue;
            }

            // Normal item
            $parent = GlobalMenuItem::create([
                'location' => $location,
                'parent_id' => null,
                'label' => $item['label'] ?? 'Item',
                'url' => $item['url'] ?? '#',
                'is_mega' => false,
                'group_title' => null,
                'page_id' => $this->resolvePageId($item['url'] ?? null),
                'item_order' => $order,
                'is_active' => true,
            ]);

            // children
            if (!empty($item['children']) && is_array($item['children'])) {
                $childOrder = 0;
                foreach ($item['children'] as $child) {
                    $childOrder++;
                    GlobalMenuItem::create([
                        'location' => $location,
                        'parent_id' => $parent->id,
                        'label' => $child['label'] ?? 'Child',
                        'url' => $child['url'] ?? '#',
                        'is_mega' => false,
                        'group_title' => null,
                        'page_id' => $this->resolvePageId($child['url'] ?? null),
                        'item_order' => $childOrder,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }

    private function resolvePageId(?string $url): ?int
    {
        if (!$url || !is_string($url)) return null;

        // only map internal routes starting with /
        if (!Str::startsWith($url, '/')) return null;

        $uri = $this->normalizeUri($url);

        // if exists -> mark live + in_menu
        $page = GlobalPage::where('route_uri', $uri)->first();

        if ($page) {
            $page->update([
                'in_menu' => true,
                'is_active' => true,
                'is_missing_route' => false,
            ]);
            return $page->id;
        }

        // if not exists (example: /home-v2ssss) -> create missing route page (keep OFF by default)
        $missing = GlobalPage::create([
            'title' => $this->titleFromUri($uri),
            'slug' => $this->slugFromUri($uri),
            'route_uri' => $uri,
            'controller' => null,
            'method' => null,
            'route_name' => null,
            'is_dynamic' => false,
            'in_menu' => true,
            'is_active' => false, // IMPORTANT: missing route shouldn't go live
            'is_missing_route' => true,
            'menu_order' => 9999,
        ]);

        return $missing->id;
    }

    private function normalizeUri(string $uri): string
    {
        $u = '/' . ltrim(trim($uri), '/');
        if ($u !== '/' && str_ends_with($u, '/')) {
            $u = rtrim($u, '/');
        }
        return $u;
    }

    private function slugFromUri(string $uri): string
    {
        $uri = $this->normalizeUri($uri);
        $slug = trim($uri, '/');
        return $slug === '' ? 'home' : Str::slug($slug);
    }

    private function titleFromUri(string $uri): string
    {
        $slug = trim($this->normalizeUri($uri), '/');
        if ($slug === '') return 'Home';
        return Str::of($slug)->replace('-', ' ')->title()->toString();
    }
}
