<script setup>
import { useTheme } from 'vuetify'
import upgradeBannerDark from '@images/pro/upgrade-banner-dark.png'
import upgradeBannerLight from '@images/pro/upgrade-banner-light.png'
import VerticalNavLayout from '@layouts/components/VerticalNavLayout.vue'
import VerticalNavLink from '@layouts/components/VerticalNavLink.vue'
import VerticalNavSectionTitle from '@/@layouts/components/VerticalNavSectionTitle.vue'

// Components
import Footer from '@/layouts/components/Footer.vue'
import NavbarThemeSwitcher from '@/layouts/components/NavbarThemeSwitcher.vue'
import UserProfile from '@/layouts/components/UserProfile.vue'

const vuetifyTheme = useTheme()

const upgradeBanner = computed(() => {
  return vuetifyTheme.global.name.value === 'light' ? upgradeBannerLight : upgradeBannerDark
})
</script>

<template>
  <VerticalNavLayout>
    <!-- 👉 navbar -->
    <template #navbar="{ toggleVerticalOverlayNavActive }">
      <div class="d-flex h-100 align-center">
        <!-- 👉 Vertical nav toggle in overlay mode -->
        <IconBtn
          class="ms-n3 d-lg-none"
          @click="toggleVerticalOverlayNavActive(true)"
        >
          <VIcon icon="mdi-menu" />
        </IconBtn>

        <!-- 👉 Search -->
        <div
          class="d-flex align-center cursor-pointer"
          style="user-select: none;"
        >
          <!-- 👉 Search Trigger button -->
          <IconBtn>
            <VIcon icon="mdi-magnify" />
          </IconBtn>

          <span class="d-none d-md-flex align-center text-disabled">
            <span class="me-3">Search</span>
            <span class="meta-key">&#8984;K</span>
          </span>
        </div>

        <VSpacer />

        <IconBtn
          class="me-2"
          href="https://github.com/themeselection/materio-vuetify-vuejs-admin-template-free"
          target="_blank"
          rel="noopener noreferrer"
        >
          <VIcon icon="mdi-whatsapp" />
        </IconBtn>

        <IconBtn class="me-2">
          <VIcon icon="mdi-bell-outline" />
        </IconBtn>

        <NavbarThemeSwitcher class="me-2" />

        <UserProfile />
      </div>
    </template>

    <template #vertical-nav-content>
      <VerticalNavLink :item="{ title: 'Dashboard', icon: 'mdi-home-outline', to: '/dashboard', }" />
      <VerticalNavLink :item="{ title: 'Utilisateurs', icon: 'mdi-account-group-outline', to: '/utilisateurs', }" />
      <VerticalNavLink :item="{ title: 'Finances', icon: 'mdi-wallet-outline', to: '/finance', }" />
      <VerticalNavLink :item="{ title: 'Messagerie', icon: 'mdi-message-processing-outline', to: '/messagerie', }" />
      <VerticalNavLink :item="{ title: 'Importations', icon: 'mdi-cloud-upload-outline', to: '/importations', }" />
      <VerticalNavLink :item="{ title: 'Paramètres', icon: 'mdi-cog-outline', to: '/parametres', }" />
      <VerticalNavLink :item="{ title: 'Statistiques', icon: 'mdi-chart-timeline-variant-shimmer', to: '/statistiques', }" />
      <VerticalNavLink :item="{ title: 'Déconnexion', icon: 'mdi-logout' }" />
    </template>
    <!-- 👉 Pages -->
    <slot />

    <!-- 👉 Footer -->
    <template #footer>
      <Footer />
    </template>
  </VerticalNavLayout>
</template>

<style lang="scss" scoped>
.meta-key {
  border: thin solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 6px;
  block-size: 1.5625rem;
  line-height: 1.3125rem;
  padding-block: 0.125rem;
  padding-inline: 0.25rem;
}
</style>
