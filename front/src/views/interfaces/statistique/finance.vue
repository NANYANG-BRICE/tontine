<template>
  <VCard title="Statistique Finances" subtitle="Toutes vos statistiques relatives à vos finances. ">
    <VCardText>
      <VExpansionPanels variant="accordion" class="customized-panels border rounded">
        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>


        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>


        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>


        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>


        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>


        <VExpansionPanel elevation="0">
          <VExpansionPanelTitle collapse-icon="mdi-minus" expand-icon="mdi-plus"
            :style="`background-color: ${isDark === 'light' ? 'var(--v-title-bg-light)' : 'var(--v-title-bg-dark)'}`">
            Finance {{ item }}
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            Sweet roll ice cream chocolate bar. Ice cream croissant sugar plum I love cupcake gingerbread
            liquorice cake. Bonbon tart caramels marshmallow chocolate cake icing icing danish pie.
          </VExpansionPanelText>
        </VExpansionPanel>
      </VExpansionPanels>
    </VCardText>
  </VCard>
</template>


<script>

  import { useTheme } from 'vuetify'

  export default {
    setup() {

      const theme = useTheme()
      const isDark = ref(theme.name)
      return {
        theme,
        isDark,
      }
    }
  }
</script>


<style lang="scss">
  .v-expansion-panels.customized-panels {
    --v-title-bg-light: rgba(var(--v-theme-on-surface), var(--v-hover-opacity));
    --v-title-bg-dark: #3d3759;

    .v-expansion-panel-title {
      border-block-end: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
      margin-block-end: -1px;
    }

    .v-expansion-panel-text__wrapper {
      padding: 20px;
    }
  }
</style>
