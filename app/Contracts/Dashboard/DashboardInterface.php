<?php


namespace App\Contracts\Dashboard;


interface DashboardInterface
{
  public function seenShareTotalCategory($parentId);
  public function topProductSeen();
  public function topProductShare();
}