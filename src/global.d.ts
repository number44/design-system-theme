interface BlockVariation {
  name: string; // A unique and machine-readable name.
  title?: string; // A human-readable variation title.
  description?: string; // A human-readable variation description.
  category?: string; // A category classification used in search interfaces to arrange block types by category.
  keywords?: string[]; // An array of terms (which can be translated) that help users discover the variation while searching.
  icon?: string | object; // An icon helping to visualize the variation. It can have the same shape as the block type.
  attributes?: object; // Values that override block attributes.
  innerBlocks?: Array<any[]>; // Initial configuration of nested blocks.
  example?: object; // Provides structured data for the block preview. Set to undefined to disable the preview. See the Block Registration API for more details.
  scope?: WPBlockVariationScope[]; // Defaults to block and inserter. The list of scopes where the variation is applicable. Available options include:
  isDefault?: boolean; // Defaults to false. Indicates whether the current variation is the default one (details below).
  isActive?: Function | string[]; // A function or an array of block attributes that is used to determine if the variation is active when the block is selected. The function accepts blockAttributes and variationAttributes (details below).
}
interface Attributes {
  message: {
    type: string;
    source: string;
    selector: string;
  };
}

interface ProvidesContext {
  "my-plugin/message": string;
}

interface Supports {
  align: boolean;
}

interface Styles {
  name: string;
  label: string;
  isDefault: boolean;
}

interface ExampleAttributes {
  message: string;
}

interface Variations {
  name: string;
  title: string;
  attributes: ExampleAttributes;
}

interface Selectors {
  root: string;
}

interface BlockSchemaI {
  $schema?: string;
  apiVersion?: number;
  name?: string;
  title?: string;
  category?: string;
  parent?: string[];
  icon?: string;
  description?: string;
  keywords?: string[];
  version?: string;
  textdomain?: string;
  attributes?: Attributes;
  providesContext?: ProvidesContext;
  usesContext?: string[];
  selectors?: Selectors;
  supports?: Supports;
  styles?: Styles[];
  example?: { attributes?: ExampleAttributes };
  variations?: Variations[];
  editorScript?: string;
  script?: string;
  viewScript?: string[];
  editorStyle?: string;
  style?: string[];
  render?: string;
}
