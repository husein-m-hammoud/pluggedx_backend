<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plugin; 

class PluginSeeder extends Seeder
{
   public function run(): void
    {
        $plugins = [

            [
                'slug' => 'margin-checker',
                'name_en' => 'Margin Checker',
                'summary_en' => 'Server-side plugin that monitors and validates free margin in position-closing scenarios.',
                'description_en' => 'A server-side plugin that monitors and validates free margin in various position-closing scenarios, particularly for accounts with hedging positions. It helps prevent forced closures and margin-related risks.',

                'name_ar' => 'مدقق الهامش',
                'summary_ar' => 'إضافة تعمل على الخادم لمراقبة والتحقق من الهامش الحر عند إغلاق الصفقات.',
                'description_ar' => 'إضافة تعمل على مستوى الخادم لمراقبة والتحقق من الهامش الحر في حالات إغلاق الصفقات المختلفة، خاصةً للحسابات التي تستخدم التحوط. تساعد في منع الإغلاقات الإجبارية والمخاطر المتعلقة بالهامش.',

                'features_en' => [
                    'Free margin validation',
                    'Hedging support',
                    'Forced closure prevention',
                    'Real-time monitoring'
                ],
                'features_ar' => [
                    'التحقق من الهامش الحر',
                    'دعم التحوط',
                    'منع الإغلاق الإجباري',
                    'مراقبة فورية'
                ],
            ],

            [
                'slug' => 'pamm',
                'name_en' => 'PAMM',
                'summary_en' => 'Percentage Allocation Management Module for investor fund allocation to money managers.',
                'description_en' => 'A PAMM system integrated with MetaTrader 5 that allows investors to allocate funds to professional money managers. Trades are executed proportionally across investor accounts based on their allocated capital.',

                'name_ar' => 'نظام PAMM',
                'summary_ar' => 'نظام إدارة توزيع النسبة لتخصيص أموال المستثمرين لمديري الأموال.',
                'description_ar' => 'نظام PAMM متكامل مع MetaTrader 5 يتيح للمستثمرين تخصيص أموالهم لمديري أموال محترفين، حيث يتم تنفيذ الصفقات بشكل نسبي حسب رأس المال المخصص لكل مستثمر.',

                'features_en' => [
                    'Proportional allocation',
                    'Investor fund management',
                    'MT5 integration',
                    'Capital-based execution'
                ],
                'features_ar' => [
                    'توزيع نسبي',
                    'إدارة أموال المستثمرين',
                    'تكامل مع MT5',
                    'تنفيذ حسب رأس المال'
                ],
            ],

            [
                'slug' => 'mam',
                'name_en' => 'MAM',
                'summary_en' => 'Multi-Account Manager for simultaneous trade execution across multiple client accounts.',
                'description_en' => 'A MAM solution for money managers using MetaTrader 5, enabling simultaneous trade execution across multiple client accounts. It is ideal for traders who manage portfolios using Expert Advisors or manual strategies.',

                'name_ar' => 'نظام MAM',
                'summary_ar' => 'مدير حسابات متعددة لتنفيذ الصفقات بشكل متزامن عبر عدة حسابات.',
                'description_ar' => 'حل MAM لمديري الأموال باستخدام MetaTrader 5 يتيح تنفيذ الصفقات بشكل متزامن عبر عدة حسابات عملاء. مثالي للمتداولين الذين يديرون محافظ باستخدام الإكسبرتات أو الاستراتيجيات اليدوية.',

                'features_en' => [
                    'Multi-account execution',
                    'EA compatible',
                    'Manual strategy support',
                    'Portfolio management'
                ],
                'features_ar' => [
                    'تنفيذ عبر عدة حسابات',
                    'متوافق مع الإكسبرت',
                    'دعم الاستراتيجيات اليدوية',
                    'إدارة المحافظ'
                ],
            ],

            [
                'slug' => 'swap-delayed',
                'name_en' => 'SwapDelayed',
                'summary_en' => 'Server-side solution enabling swap charges only after a predefined number of days.',
                'description_en' => 'A server-side solution that enables swap charges only after a predefined number of days for selected MT5 groups, allowing flexible swap and rollover policies.',

                'name_ar' => 'تأجيل السواب',
                'summary_ar' => 'حل على مستوى الخادم لتطبيق رسوم السواب بعد عدد أيام محدد.',
                'description_ar' => 'حل يعمل على الخادم يسمح بتطبيق رسوم السواب فقط بعد عدد أيام محدد لمجموعات MT5 معينة، مما يتيح سياسات مرنة لاحتساب السواب والتمديد.',

                'features_en' => [
                    'Delayed swap charges',
                    'Group-based configuration',
                    'Flexible rollover policies',
                    'MT5 server-side'
                ],
                'features_ar' => [
                    'تأجيل رسوم السواب',
                    'إعداد حسب المجموعة',
                    'سياسات تمديد مرنة',
                    'حل على مستوى MT5'
                ],
            ],

            [
                'slug' => 'trade-copier',
                'name_en' => 'TradeCopier',
                'summary_en' => 'Trade-copying solution replicating trades from master to follower accounts.',
                'description_en' => 'A trade-copying solution that replicates trades from multiple master accounts to multiple follower accounts, with configurable multipliers and advanced control settings.',

                'name_ar' => 'ناسخ الصفقات',
                'summary_ar' => 'حل لنسخ الصفقات من حسابات رئيسية إلى حسابات تابعة.',
                'description_ar' => 'حل لنسخ الصفقات يقوم بتكرار الصفقات من عدة حسابات رئيسية إلى عدة حسابات تابعة مع إمكانية ضبط المضاعفات وإعدادات تحكم متقدمة.',

                'features_en' => [
                    'Multi-master support',
                    'Configurable multipliers',
                    'Advanced controls',
                    'Real-time replication'
                ],
                'features_ar' => [
                    'دعم عدة حسابات رئيسية',
                    'مضاعفات قابلة للتخصيص',
                    'تحكم متقدم',
                    'نسخ فوري'
                ],
            ],
        ];

        foreach ($plugins as $plugin) {
            Plugin::updateOrCreate(
                ['slug' => $plugin['slug']],
                $plugin
            );
        }
    }
}
