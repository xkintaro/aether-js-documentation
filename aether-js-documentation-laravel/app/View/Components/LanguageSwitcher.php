<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

/**
 * Dil Değiştirme (Language Switcher) Blade Bileşeni.
 *
 * Bu bileşen (<x-language-switcher ... />), sitenin dilleri arasında
 * geçiş yapmak için linkler oluşturan bir dropdown menüyü render eder.
 *
 * En önemli özelliği "akıllı" olmasıdır:
 * Sadece anasayfaya değil, o an bulunulan sayfanın (örn: bir ürün detayı)
 * diğer dildeki karşılığına link vermeye çalışır.
 */
class LanguageSwitcher extends Component
{
    /**
     * @var array Blade'de ($links) olarak erişilecek, link objelerini
     * (örn: {code: 'EN', url: '...', isActive: true}) içeren dizi.
     */
    public array $links = [];

    /**
     * @var string Dropdown menü için benzersiz HTML ID'si (Erişilebilirlik - ARIA için).
     */
    public string $uniqueId;

    /**
     * Bileşeni (Component) başlatır.
     *
     * @param string $locale O anki aktif dil (örn: 'tr').
     * @param mixed $viewModel O anki sayfanın ViewModel'i (örn: PageViewModel, ProductViewModel).
     * Bu, sayfanın modeline (entity) erişmek için gereklidir.
     * @param ?string $uniqueId (İsteğe bağlı) Erişilebilirlik için özel bir ID.
     */
    public function __construct(string $locale, mixed $viewModel = null, ?string $uniqueId = null)
    {
        // Ana link oluşturma mantığını çalıştır.
        $this->links = $this->generateLinks($locale, $viewModel);

        // HTML için benzersiz bir ID ata.
        $this->uniqueId = $uniqueId ?? 'lang-switcher-' . uniqid();
    }

    /**
     * Diğer dillere ait linkleri oluşturan ana iş mantığı.
     *
     * @param string $currentLocale O anki aktif dil (örn: 'tr').
     * @param mixed $viewModel O anki sayfanın ViewModel'i.
     * @return array Link objeleri dizisi.
     */
    private function generateLinks(string $currentLocale, mixed $viewModel): array
    {
        $links = [];
        // config/voyager.php'den desteklenen tüm dilleri al (örn: ['tr', 'en']).
        $supportedLocales = config('voyager.multilingual.locales');

        // O anki aktif rotayı (route) al.
        $currentRoute = Route::current();
        if (!$currentRoute) {
            return $links; // Rota bulunamazsa (örn: 404 sayfası) boş dizi döndür.
        }

        // O anki rotanın parametrelerini (örn: ['locale' => 'en', 'slug' => 'about-us'])
        // ve adını (örn: 'resolver') al.
        $currentParams = $currentRoute->parameters();
        $currentRouteName = $currentRoute->getName();

        // --- AKILLI ÇEVİRİ MANTIĞI ---
        $entity = null;
        // 1. Eğer 'resolver' rotasındaysak (yani Page, Product veya Category sayfasındaysak),
        // 2. ve Controller bize 'viewModel'i göndermişse,
        // 3. ve bu 'viewModel'in 'getModel()' metodu varsa...
        if ($currentRouteName === 'resolver' && isset($viewModel) && method_exists($viewModel, 'getModel')) {
            // ...o zaman bu 'viewModel'den o anki sayfanın
            // ham Eloquent modelini (Page, Product vb.) al.
            $entity = $viewModel->getModel();
        }
        // --- BİTTİ ---

        // Desteklenen her bir dil ('tr', 'en'...) için bir link oluştur.
        foreach ($supportedLocales as $langLocale) {

            // Yeni linkin parametrelerini, mevcut linkin parametreleriyle başlat.
            $langParams = $currentParams;
            // 'locale' parametresini hedef dil ile değiştir (örn: 'en' -> 'tr').
            $langParams['locale'] = $langLocale;

            // KURAL 1: 'resolver' rotasındaysak (ve $entity bulunduysa),
            // 'slug' parametresini o dilin çevrilmiş slug'ıyla değiştir.
            if ($entity && method_exists($entity, 'getPath')) {
                // $entity->getPath('tr') metodunu çağır (örn: 'hakkimizda').
                // 'Page', 'Product' ve 'Category' modellerimizin tümü bu metodu destekler.
                $langParams['slug'] = $entity->getPath($langLocale);
            }

            // KURAL 2: 'products.search' (arama) sayfasındaysak,
            // 'q=test' gibi mevcut filtre parametrelerini koru.
            if ($currentRouteName === 'products.search') {
                // Mevcut query string (?q=test) ile yeni $langParams'ı birleştir.
                $langParams = array_merge(request()->query(), $langParams);
            }

            // Linki oluşturmayı dene.
            try {
                $links[] = (object) [
                    'code' => strtoupper($langLocale),
                    'url' => route($currentRouteName, $langParams),
                    'isActive' => ($langLocale === $currentLocale),
                ];
            } catch (\Exception $e) {
                // HATA DURUMU: 'route()' metodu patlayabilir.
                // (Örn: Bir ürünün 'tr' çevirisi var ama 'de' çevirisi yoksa
                // 'getPath('de')' null döner ve 'slug' parametresi eksik kalır).
                // Bu durumda, sayfanın çökmesini engelle.
                // Fallback (yedek) olarak o dilin anasayfasına link ver.
                $links[] = (object) [
                    'code' => strtoupper($langLocale),
                    'url' => url($langLocale), // Örn: /tr
                    'isActive' => ($langLocale === $currentLocale),
                ];
            }
        }

        return $links;
    }

    /**
     * Bileşeni render etmek için hangi view dosyasının kullanılacağını belirler.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // 'resources/views/components/language-switcher.blade.php'
        // dosyasını render et.
        return view('components.language-switcher');
    }
}
